<?php

namespace Wecanit\Car;

use Avtocod\B2BApi\Client;
use Avtocod\B2BApi\Params\UserParams;
use Avtocod\B2BApi\Params\UserReportMakeParams;
use Avtocod\B2BApi\Params\UserReportParams;
use Avtocod\B2BApi\Responses\Entities\ReportContent;
use Avtocod\B2BApi\Settings;
use Avtocod\B2BApi\Tokens\Auth\AuthToken;


class Report
{
    /** @var Client $client */
    private $client;
    private $domain;

    private const API_VENDOR_KEY = 'tech_data.brand.name.normalized';
    private const API_ORIGINAL_NAME_KEY = 'tech_data.brand.name.original';
    private const API_MODEL_KEY = 'tech_data.model.name.normalized';
    private const API_YEAR_KEY = 'tech_data.year';
    private const API_POWER_KEY = 'tech_data.engine.power.hp';
    private const API_WEIGHT_KEY = 'tech_data.engine.volume';
    private const API_FUEL_KEY = 'tech_data.engine.fuel.type';
    private const API_DRIVE_KEY = 'tech_data.drive.type';
    private const API_BODY_KEY = 'identifiers.vehicle.body';

    private const VENDOR_KEY = 'vendor';
    private const MODEL_KEY = 'model';
    private const YEAR_KEY = 'year';
    private const POWER_KEY = 'power';
    private const WEIGHT_KEY = 'weight';
    private const FUEL_KEY = 'fuel';
    private const DRIVE_KEY = 'drive';
    private const BODY_KEY = 'body';

    private const BASE_URL = 'https://b2b-api.spectrumdata.ru/b2b/api/v1/';

    private const BODY_REPORT_TYPE = 'report_identifiers';
    private const TECH_REPORT_TYPE = 'report_autocomplete_plus';

    /**
     * Report constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $user = (string) \COption::GetOptionString('wecanit.car', 'WECAN_REPORTS_USERNAME');

        if (!$user) {
            throw new \Exception('service user not found');
        }

        $password = (string) \COption::GetOptionString('wecanit.car', 'WECAN_REPORTS_PASSWORD');

        if (!$password) {
            throw new \Exception('service user password not found');
        }

        $this->domain = (string) \COption::GetOptionString('wecanit.car', 'WECAN_REPORTS_DOMAIN');

        if (!$this->domain) {
            throw new \Exception('service user domain not found');
        }

        $this->client = new Client(new Settings(AuthToken::generate($user, $password, $this->domain), self::BASE_URL));
    }

    /**
     * @param string $grz
     * @return array
     * @throws \Exception
     */
    public function getReportByGrz(string $grz): array
    {
        $techReport = $this->getReportByType(self::TECH_REPORT_TYPE, $grz);

        $bodyReport = $this->getReportByType(self::BODY_REPORT_TYPE, $grz);

        $vendor = $techReport->getByPath(self::API_VENDOR_KEY);
        $model = $techReport->getByPath(self::API_MODEL_KEY);

        if (!$vendor) {
            $originalName = $techReport->getByPath(self::API_ORIGINAL_NAME_KEY);

            list($vendor, $model) = explode(' ', $originalName, 2);
        }

        return [
            self::VENDOR_KEY => $vendor,
            self::MODEL_KEY => $model,
            self::YEAR_KEY => $techReport->getByPath(self::API_YEAR_KEY),
            self::POWER_KEY => $techReport->getByPath(self::API_POWER_KEY),
            self::WEIGHT_KEY => $techReport->getByPath(self::API_WEIGHT_KEY),
            self::FUEL_KEY => $techReport->getByPath(self::API_FUEL_KEY),
            self::DRIVE_KEY => $techReport->getByPath(self::API_DRIVE_KEY),
            self::BODY_KEY => $bodyReport->getByPath(self::API_BODY_KEY),
        ];
    }

    /**
     * @param string $type
     * @param string $grz
     * @return ReportContent|null
     */
    private function getReportByType(string $type, string $grz):?ReportContent
    {
        $report = $this->client
            ->userReportMake(
                (new UserReportMakeParams($type . '@' . $this->domain, 'GRZ', $grz))
            )->first();

        $reportUid = $report->getReportUid();

        while (true) {
            $userReportParams = (new UserReportParams($reportUid))->setIncludeContent(false);
            if ($this->client->userReport($userReportParams)->first()->isCompleted()) {
                break;
            }

            \sleep(0.5);
        }

        return $this->client->userReport(new UserReportParams($reportUid))->first()->getContent();
    }

    private function isValidGrz(string $grz): bool
    {
        if (!$grz) { //todo
            return false;
        }

        return true;
    }
}