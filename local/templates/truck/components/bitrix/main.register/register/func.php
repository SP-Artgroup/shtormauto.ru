<?php

function showField($field)
{
    if (
        !$field
        || (isset($field['hide']) && $field['hide'])
        || !isset($field['tag'])
    ) {
        return;
    }

    $tag = $field['tag'];

    if (isset($field['label'])) {

        $label = $field['label'];
        $text  = $label['text'] ?? '';

        echo '<label for="' . $field['attrs']['name'] . '"';

        if (isset($label['attrs'])) {

            foreach ($label['attrs'] as $name => $value) {
                echo " $name=\"$value\"";
            }
        }

        echo '>' . $text . '</label>';
    }

    echo '<' . $tag;

    showAttrs($field['attrs']);

    echo '>';

    if ($tag !== 'input') {

        if ($tag === 'textarea' && isset($field['text'])) {

            echo $field['text'];

        } elseif ($tag === 'select' && isset($field['options'])) {

            foreach ($field['options'] as $option) {

                $text = $option['text'] ?? '';
                unset($option['text']);

                echo '<option';

                showAttrs($option);

                echo '>' . $text . '</option>';
            }
        }

        echo '</' . $tag . '>';
    }
}

function showAttrs($attrs)
{
    foreach ($attrs as $name => $value) {
        echo " $name=\"$value\"";
    }
}

$field['value'] = [
    [
        ''
    ],
];