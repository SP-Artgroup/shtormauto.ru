<?php

namespace Local\Truck;

/**
 *
 */
class Form
{
    private $attrs;
    private $fields;

    public function __construct(array $data)
    {
        $this->attrs  = $data['attrs'];
        $this->fields = $data['fields'];
    }

    public function open()
    {
        echo '<form';
        $this->attrs($this->attrs);
        echo '>';
    }

    public function close()
    {
        echo '</form>';
    }

    public function field($name)
    {
        if (!isset($this->fields[$name])) {
            return;
        }

        $field     = $this->fields[$name];
        $label     = $field['label'] ?? null;
        $labelType = $label ? $label['type'] : null;

        if ($labelType) {
            $this->label($field);
        } else {
            $this->__field($field);
        }
    }

    public function full()
    {
        $this->open();

        foreach (array_keys($this->fields) as $name) {
            $this->field($name);
        }

        $this->close();
    }

    private function __field($field)
    {
        $tag = $field['tag'];

        echo '<' . $tag;

        $this->attrs($field['attrs']);

        echo '>';

        if ($tag !== 'input') {

            if ($tag === 'textarea' && isset($field['text'])) {

                echo $field['text'];

            } elseif ($tag === 'select' && isset($field['options'])) {

                foreach ($field['options'] as $option) {

                    $text = $option['text'] ?? '';

                    echo '<option';

                    $this->attrs($option['attrs']);

                    echo '>' . $text . '</option>';
                }
            }

            echo '</' . $tag . '>';
        }
    }

    private function attrs(array $attrs)
    {
        foreach ($attrs as $name => $value) {
            echo " $name=\"$value\"";
        }
    }

    private function label($field)
    {
        if (isset($field['label'])) {

            $label     = $field['label'];
            $text      = $label['text'] ?? '';
            $wrapField = $label['type'] === 'wrap';

            echo '<label for="' . $field['attrs']['name'] . '"';

            if (isset($label['attrs'])) {
                $this>attrs($label['attrs']);
            }

            echo '>' . $text;

            if ($wrapField) {
                $this->__field($field);
            }

            echo '</label>';
        }
    }
}
