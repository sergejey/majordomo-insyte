<?php

$this->device_types = array(
    'spider_plc' => array(
        'TITLE' => 'SPIDER PLC',
        'manual' => 'https://insyte.ru/upload/iblock/aea/tekhnicheskoe-opisanie-spider2.3.pdf',
        'commands' =>
            array(
                'temperature' => array(
                    'fread' => 3,
                    'fwrite' => 6,
                    'address' => 4,
                    'count' => 2,
                    'response_convert' => 'r2f'
                ),
                'controller_state' => array(
                    'fread' => 3,
                    'fwrite' => 6,
                    'address' => 100,
                    'response_convert' => 'i2i'
                ),
                'input1' => array(
                    'fread' => 2,
                    'address' => 1,
                ),
                'input2' => array(
                    'fread' => 2,
                    'address' => 2,
                ),
                'input3' => array(
                    'fread' => 2,
                    'address' => 3,
                ),
                'input4' => array(
                    'fread' => 2,
                    'address' => 4,
                ),
                'output1' => array(
                    'fread' => 1,
                    'fwrite' => 5,
                    'address' => 1,
                    'sdevice' => 'relay',
                ),
                'output2' => array(
                    'fread' => 1,
                    'fwrite' => 5,
                    'address' => 2,
                    'sdevice' => 'relay',
                ),
                'output3' => array(
                    'fread' => 1,
                    'fwrite' => 5,
                    'address' => 3,
                    'sdevice' => 'relay',
                ),
                'output4' => array(
                    'fread' => 1,
                    'fwrite' => 5,
                    'address' => 4,
                    'sdevice' => 'relay',
                ),
                '_config_address' => array(
                    'fread'=>3,
                    'fwrite'=>16,
                    'address'=>9000,
                    'response_convert' => 'i2i',
                ),

                '_config_type' => array(
                    'fread'=>3,
                    'address'=>9002,
                    'response_convert' => 'i2i',
                ),
            )
    ),
    'ld2_r1000d' => array( //блок реле
        'TITLE' => 'LD2-R1000D',
        'manual' => 'https://insyte.ru/upload/iblock/830/830c7b7d9453b70c3da86967ebceb9db.pdf',
        'commands' => array(
            'output' => array(
                'fread' => 1,
                'fwrite' => 15,
                'address' => 1,
                'sdevice' => 'relay'
            ),
            'input1' => array(
                'fread' => 2,
                'address' => 1,
            ),
            'input2' => array(
                'fread' => 2,
                'address' => 2,
            ),
            '_config_address' => array(
                'fread'=>3,
                'fwrite'=>16,
                'address'=>9000,
                'response_convert' => 'i2i',
            ),

            '_config_type' => array(
                'fread'=>3,
                'address'=>9002,
                'response_convert' => 'i2i',
            ),
            /*

'_config_rate' => array(
                'fread'=>3,
                'fwrite'=>16,
                'address'=>9001,
                'response_convert' => 'i2i',
            ),


'_config_script' => array(
'fread'=>3,
'fwrite'=>16,
'address'=>9003,
'response_convert' => 'i2i',
),

'_config_service_pin' => array(
'fread'=>3,
'address'=>9004,
'response_convert' => 'i2i',
),

            '_config_version' => array(
                'fread'=>3,
                'address'=>9005,
                'response_convert' => 'i2i',
            ),
            */

        )
    ),
    'ld2_ssd' => array( // блок мотора
        'TITLE' => 'LD2-SSD',
        'manual' => 'https://insyte.ru/upload/iblock/8b4/8b4302d71c0d27841b06cfba417fcd3b.pdf',
        'commands' => array(
            'direction' => array(
                'fread' => 3,
                'fwrite' => 16,
                'address' => 1,
                'response_convert' => 'i2i',
            ),
            'input1' => array(
                'fread' => 2,
                'address' => 1,
            ),
            'input2' => array(
                'fread' => 2,
                'address' => 2,
            ),
            '_config_address' => array(
                'fread'=>3,
                'fwrite'=>16,
                'address'=>9000,
                'response_convert' => 'i2i',
            ),

            '_config_type' => array(
                'fread'=>3,
                'address'=>9002,
                'response_convert' => 'i2i',
            ),
        )
    ),
    'ld2_1d400d' => array( // диммер
        'TITLE' => 'LD2-1D400D',
        'manual' => 'https://insyte.ru/upload/iblock/0fd/ld2_1d400d.pdf',
        'commands' => array(
            'level' => array(
                'fread' => 3,
                'fwrite' => 16,
                'address' => 1,
                'response_convert' => 'i2i',
                'sdevice' => 'dimmer',
            ),
            'delay' => array(
                'fread' => 3,
                'fwrite' => 16,
                'address' => 2,
                'response_convert' => 'i2i'
            ),
            'level_min' => array(
                'fread' => 3,
                'fwrite' => 16,
                'address' => 3,
                'response_convert' => 'i2i'
            ),
            'input1' => array(
                'fread' => 2,
                'address' => 1,
            ),
            'input2' => array(
                'fread' => 2,
                'address' => 2,
            ),
            '_config_address' => array(
                'fread'=>3,
                'fwrite'=>16,
                'address'=>9000,
                'response_convert' => 'i2i',
            ),

            '_config_type' => array(
                'fread'=>3,
                'address'=>9002,
                'response_convert' => 'i2i',
            ),
        )
    ),
    'ld2_u2400d' => array( // блок расширения
        'TITLE' => 'LD2-U2400D',
        'manual' => 'https://insyte.ru/upload/iblock/da8/manual_ld2_u2400d.pdf',
        'commands' => array(
            'input1' => array(
                'fread' => 2,
                'address' => 1,
            ),
            'input2' => array(
                'fread' => 2,
                'address' => 2,
            ),
            'input3' => array(
                'fread' => 2,
                'address' => 3,
            ),
            'input4' => array(
                'fread' => 2,
                'address' => 4,
            ),
            'output1' => array(
                'fread' => 1,
                'fwrite' => 15,
                'address' => 1,
                'sdevice' => 'relay'
            ),
            'output2' => array(
                'fread' => 1,
                'fwrite' => 15,
                'address' => 2,
                'sdevice' => 'relay'
            ),
            'output3' => array(
                'fread' => 1,
                'fwrite' => 15,
                'address' => 3,
                'sdevice' => 'relay'
            ),
            'output4' => array(
                'fread' => 1,
                'fwrite' => 15,
                'address' => 4,
                'sdevice' => 'relay'
            ),
            'adc1' => array(
                'fread' => 3,
                'address' => 1,
                'response_convert' => 'i2i'
            ),
            'adc2' => array(
                'fread' => 3,
                'address' => 2,
                'response_convert' => 'i2i'
            ),
            'adc3' => array(
                'fread' => 3,
                'address' => 3,
                'response_convert' => 'i2i'
            ),
            'dac1' => array(
                'fread' => 3,
                'fwrite' => 16,
                'address' => 4,
                'response_convert' => 'i2i'
            ),
            'dac2' => array(
                'fread' => 3,
                'fwrite' => 16,
                'address' => 5,
                'response_convert' => 'i2i'
            ),
            'dac3' => array(
                'fread' => 3,
                'fwrite' => 16,
                'address' => 6,
                'response_convert' => 'i2i'
            ),
            '_config_address' => array(
                'fread'=>3,
                'fwrite'=>16,
                'address'=>9000,
                'response_convert' => 'i2i',
            ),

            '_config_type' => array(
                'fread'=>3,
                'address'=>9002,
                'response_convert' => 'i2i',
            ),
        )
    ),
    'ld2_pwmd' => array(
        'TITLE' => 'LD2-PWMD',
        'manual' => 'https://insyte.ru/upload/iblock/9a1/9a1570715e4437f58f5ff1f53390f712.pdf',
        'commands' => array(
            'switch_time' => array(
                'fread' => 3,
                'fwrite' => 16,
                'address' => 1,
                'response_convert' => 'i2i',
                'sdevice' => 'dimmer',
            ),
            'level' => array(
                'fread' => 3,
                'fwrite' => 16,
                'address' => 2,
                'response_convert' => 'i2i',
                'sdevice' => 'dimmer',
            ),
            'level_instant' => array(
                'fread' => 3,
                'fwrite' => 16,
                'address' => 3,
                'response_convert' => 'i2i',
                'sdevice' => 'dimmer',
            ),
            '_config_address' => array(
                'fread'=>3,
                'fwrite'=>16,
                'address'=>9000,
                'response_convert' => 'i2i',
            ),

            '_config_type' => array(
                'fread'=>3,
                'address'=>9002,
                'response_convert' => 'i2i',
            ),
        )
    ),
    'ld2_pwm' => array(
        'TITLE' => 'LD2-PWM',
        'copy' => 'ld2_pwmd'
    ),
    'ld2_th' => array(
        'TITLE' => 'LD2-TH',
        'manual' => 'https://insyte.ru/upload/iblock/673/6738db20e6193f1643e9ac3331d0631d.pdf',
        'commands' => array(
            'temperature' => array(
                'fread' => 3,
                'address' => 1,
                'response_convert' => 'i2i',
                'sdevice' => 'sensor_temp',
            ),
            '_config_address' => array(
                'fread'=>3,
                'fwrite'=>16,
                'address'=>9000,
                'response_convert' => 'i2i',
            ),

            '_config_type' => array(
                'fread'=>3,
                'address'=>9002,
                'response_convert' => 'i2i',
            ),
        )
    ),
    'ld2_thd' => array(
        'TITLE' => 'LD2-THD',
        'copy'=>'ld2_th',
    ),
    'ld2_4in' => array(
        'TITLE' => 'LD2-4IN',
        'manual' => 'https://insyte.ru/upload/iblock/729/7299f1d8bb69d4786ef62ebe5bdcbb6a.pdf',
        'commands' => array(
            'input1' => array(
                'fread' => 2,
                'address' => 1,
            ),
            'input2' => array(
                'fread' => 2,
                'address' => 2,
            ),
            'input3' => array(
                'fread' => 2,
                'address' => 2,
            ),
            'input4' => array(
                'fread' => 2,
                'address' => 2,
            ),
            '_config_address' => array(
                'fread'=>3,
                'fwrite'=>16,
                'address'=>9000,
                'response_convert' => 'i2i',
            ),

            '_config_type' => array(
                'fread'=>3,
                'address'=>9002,
                'response_convert' => 'i2i',
            ),
        )
    ),
    'ld2_4ind' => array(
        'TITLE' => 'LD2-4IND',
        'copy' => 'ld2_4in',
    ),
    'ld2_ir' => array(
        'TITLE' => 'LD2-IR',
        'manual' => 'https://insyte.ru/upload/iblock/5b6/5b669e735da24484b150dc7369c52dd8.pdf',
        'commands' => array(
            'command_send' => array(
                'fread'=>3,
                'fwrite'=>16,
                'address'=>1,
                'response_convert' => 'i2i',
            ),
            'command_received' => array(
                'fread'=>3,
                'address'=>2,
                'response_convert' => 'i2i',
            ),
            'command_record' => array(
                'fread'=>3,
                'fwrite'=>16,
                'address'=>3,
                'response_convert' => 'i2i',
            ),
            '_config_address' => array(
                'fread'=>3,
                'fwrite'=>16,
                'address'=>9000,
                'response_convert' => 'i2i',
            ),

            '_config_type' => array(
                'fread'=>3,
                'address'=>9002,
                'response_convert' => 'i2i',
            ),
        )

    ),
    'ld2_4d400'=> array(
        'TITLE' => 'LD2-4D400D',
        'manual' => 'https://insyte.ru/upload/iblock/3ab/ld2_4d400d.pdf',
        'commands'=>array(
            'level1' => array(
                'fread' => 3,
                'fwrite' => 16,
                'address' => 1,
                'response_convert' => 'i2i',
                'sdevice' => 'dimmer',
            ),
            'level2' => array(
                'fread' => 3,
                'fwrite' => 16,
                'address' => 2,
                'response_convert' => 'i2i',
                'sdevice' => 'dimmer',
            ),
            'level3' => array(
                'fread' => 3,
                'fwrite' => 16,
                'address' => 3,
                'response_convert' => 'i2i',
                'sdevice' => 'dimmer',
            ),
            'level4' => array(
                'fread' => 3,
                'fwrite' => 16,
                'address' => 4,
                'response_convert' => 'i2i',
                'sdevice' => 'dimmer',
            ),
            'delay1' => array(
                'fread' => 3,
                'fwrite' => 16,
                'address' => 5,
                'response_convert' => 'i2i'
            ),
            'delay2' => array(
                'fread' => 3,
                'fwrite' => 16,
                'address' => 6,
                'response_convert' => 'i2i'
            ),
            'delay3' => array(
                'fread' => 3,
                'fwrite' => 16,
                'address' => 7,
                'response_convert' => 'i2i'
            ),
            'delay4' => array(
                'fread' => 3,
                'fwrite' => 16,
                'address' => 8,
                'response_convert' => 'i2i'
            ),
            'level_min1' => array(
                'fread' => 3,
                'fwrite' => 16,
                'address' => 9,
                'response_convert' => 'i2i'
            ),
            'level_min2' => array(
                'fread' => 3,
                'fwrite' => 16,
                'address' => 10,
                'response_convert' => 'i2i'
            ),
            'level_min3' => array(
                'fread' => 3,
                'fwrite' => 16,
                'address' => 11,
                'response_convert' => 'i2i'
            ),
            'level_min4' => array(
                'fread' => 3,
                'fwrite' => 16,
                'address' => 12,
                'response_convert' => 'i2i'
            ),
            'input1' => array(
                'fread' => 2,
                'address' => 1,
            ),
            'input2' => array(
                'fread' => 2,
                'address' => 2,
            ),
            'input3' => array(
                'fread' => 2,
                'address' => 2,
            ),
            'input4' => array(
                'fread' => 2,
                'address' => 2,
            ),
            'input5' => array(
                'fread' => 2,
                'address' => 1,
            ),
            'input6' => array(
                'fread' => 2,
                'address' => 2,
            ),
            'input7' => array(
                'fread' => 2,
                'address' => 2,
            ),
            'input8' => array(
                'fread' => 2,
                'address' => 2,
            ),
            '_config_address' => array(
                'fread'=>3,
                'fwrite'=>16,
                'address'=>9000,
                'response_convert' => 'i2i',
            ),

            '_config_type' => array(
                'fread'=>3,
                'address'=>9002,
                'response_convert' => 'i2i',
            ),
        )
    ),
    'ld2_d400rd' => array(
        'TITLE' => 'LD2-D400RD',
        'manual' => 'https://insyte.ru/upload/iblock/438/4384e4c1364f883e2a5561acc16ba0c5.pdf',
        'commands' => array(
            'delay' => array(
                'fread' => 3,
                'fwrite' => 16,
                'address' => 1,
                'response_convert' => 'i2i',
                'sdevice' => 'dimmer',
            ),
            'level' => array(
                'fread' => 3,
                'fwrite' => 16,
                'address' => 2,
                'response_convert' => 'i2i'
            ),
            'power' => array(
                'fread' => 3,
                'address' => 3,
                'response_convert' => 'i2i'
            ),
            'input1' => array(
                'fread' => 2,
                'address' => 1,
            ),
            'input2' => array(
                'fread' => 2,
                'address' => 2,
            ),
            '_config_address' => array(
                'fread'=>3,
                'fwrite'=>16,
                'address'=>9000,
                'response_convert' => 'i2i',
            ),
            '_config_type' => array(
                'fread'=>3,
                'address'=>9002,
                'response_convert' => 'i2i',
            ),
        )
    ),
    'ld2_d1000rd' => array(
        'TITLE' => 'LD2-D1000RD',
        'copy' => 'ld2_d400rd',
    ),

);

foreach($this->device_types as $k=>$v) {
    if ($v['copy']) {
        foreach($v as $kv=>$vv) {
            if (!isset($this->device_types[$k][$kv])) {
                $this->device_types[$k][$kv]=$this->device_types[$v['copy']][$kv];
            }
        }
    }
}