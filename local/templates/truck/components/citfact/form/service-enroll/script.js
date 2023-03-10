(function (window, $) {
  'use strict';

  /**
   * Construct object
   * @param {object} params
   * @constructor
   */
  window.FormGenerator = function (params) {
    this.form = params.formContainer;
    this.ajaxMode = params.ajaxMode;
    this.captchaImg = params.captchaImg;
    this.captchaReload = params.captchaReload;
    this.uri = params.uri;
    this.initCalendar();
  }

  /**
   * Init events
   * @return {*}
   */
  FormGenerator.prototype.init = function () {
    this.reloadCaptcha();
    if (this.ajaxMode) {
      this.submitForm();
    }
  }

  /**
   * Event submit form when ajaxMode = true
   * @return {*}
   */
  FormGenerator.prototype.submitForm = function () {
    var self = this;
    $(document).on('submit', this.form, function () {

      var prefix = this.name;
      var fields = [
        BX(prefix + '[CLIENT_NAME]').value,
        BX(prefix + '[PHONE]').value,
        BX(prefix + '[AUTO_INFO]').value,
      ];

      BX(prefix + '[NAME]').value = fields.join(', ');

      if(typeof FormData === 'function'){
        var formData = new FormData($(this)[0]);

        $.ajax({
          url: self.uri,
          type: 'POST',
          data: formData,
          async: true,
          success: function (response) {
            $(self.form).replaceWith(response.html);
            self.reloadCaptcha();
            self.initCalendar();
          },
          cache: false,
          contentType: false,
          processData: false
        });

      } else {
        $.post(self.uri, $(self.form).serialize(), function (response) {
          $(self.form).replaceWith(response.html);
          self.reloadCaptcha();
          self.initCalendar();
        });
      }

      return false;
    });
  }

  /**
   * Event reload captcha
   * @return {*}
   */
  FormGenerator.prototype.reloadCaptcha = function () {
    var self = this;
    $(this.form).on('click', this.captchaReload, function () {
      $.post(self.uri, $(self.form).serialize(), function (response) {
        self.setCaptcha(response.captcha);
      });

      return false;
    });
  }

  /**
   * Set new captcha
   * @param {string} code
   * @return {*}
   */
  FormGenerator.prototype.setCaptcha = function (code) {
    $(this.form).find('input[name*=captcha_sid]').val(code);
    $(this.form).find(this.captchaImg).prop('src', '/bitrix/tools/captcha.php?captcha_sid=' + code);
  }

  FormGenerator.prototype.initCalendar = function () {
    $('#datetimepicker', this.form).datetimepicker({
      format: 'DD.MM.YY HH:mm',
      locale: 'ru'
    });
  }

})(window, window.jQuery);