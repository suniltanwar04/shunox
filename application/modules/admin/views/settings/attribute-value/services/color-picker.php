<?php
if ($attributeName == 'color' || $attributeName == 'colour') {
    ?>


    <input type="text" class="form-control" id="addAttributeValue"
           name="addAttributeValue" value="pink"
           placeholder="Attribute Value">
    <style>
        .colorpicker-2x .colorpicker-saturation {
            width: 200px;
            height: 200px;
        }

        .colorpicker-2x .colorpicker-hue,
        .colorpicker-2x .colorpicker-alpha {
            width: 30px;
            height: 200px;
        }

        .colorpicker-2x .colorpicker-color,
        .colorpicker-2x .colorpicker-color div {
            height: 30px;
        }
    </style>
    <script>
        $(function () {
            $('#addAttributeValue').colorpicker({
                customClass: 'colorpicker-2x',
                sliders: {
                    saturation: {
                        maxLeft: 200,
                        maxTop: 200
                    },
                    hue: {
                        maxTop: 200
                    },
                    alpha: {
                        maxTop: 200
                    }
                },
                format: 'hex'
            });
        });
    </script>
    <span id="addattributeValueError" style="color: red;"></span>
    <?php
} else {
    ?>
    <input type="text" class="form-control" id="addAttributeValue"
           name="addAttributeValue"
           maxlength="50"
           placeholder="Attribute Value">
    <span id="addattributeValueError" style="color: red;"></span>

    <?php
}