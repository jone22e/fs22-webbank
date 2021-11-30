<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use PHPJasper\PHPJasper;

extract($_POST);

$sections = json_decode($json);

$xml = '<?xml version="1.0" encoding="UTF-8"?>';
//groovy
$xml .= '<jasperReport xmlns="http://jasperreports.sourceforge.net/jasperreports" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://jasperreports.sourceforge.net/jasperreports http://jasperreports.sourceforge.net/xsd/jasperreport.xsd" name="extrato" language="java" pageWidth="595" pageHeight="842" columnWidth="555" leftMargin="20" rightMargin="20" topMargin="20" bottomMargin="20">';



//parameters
$xml .= '<parameter name="PERIODO" class="java.lang.String"/>';
$xml .= '<parameter name="CONTA" class="java.lang.String"/>';


//fields
$xml .= '<field name="Data" class="java.lang.String"/>
        <field name="Descrição" class="java.lang.String"/>
        <field name="Favorecido" class="java.lang.String"/>
        <field name="Entrada" class="java.lang.String"/>
        <field name="Saída" class="java.lang.String"/>
        <field name="Saldo" class="java.lang.String"/>';

$xml .= '<background>
		<band splitType="Stretch"/>
	</background>';

function nopx($txt) {
    return str_replace("px", "", $txt);
}

foreach ($sections as $section) {

    $elements = "";
    foreach ($section->section->elements as $element) {

        //<![CDATA[Balance]]>
        $expression = '<![CDATA['.$element->element->html.']]>';
        $x = intval(nopx($element->element->left));
        $y = intval(nopx($element->element->top));
        $width = intval(nopx($element->element->width));
        $height = intval(nopx($element->element->height));
        $font = nopx($element->element->fontsize);

        $elements .= '<textField>
                        <reportElement x="'.$x.'" y="'.$y.'" width="'.$width.'" height="'.$height.'"/>
                        <textElement markup="none">
                            <font size="'.$font.'" isBold="false"/>
                        </textElement>
                        <textFieldExpression>'.$expression.'</textFieldExpression>
                    </textField>';
    }

    $xml .= '<'.$section->section->type.'>
    <band height="'.nopx($section->section->height).'" splitType="Stretch">
    '.$elements.'
    </band>
    </'.$section->section->type.'>'."\n";
}

$xml .= '</jasperReport>';

$jrxml = 'report_'.date('YmdHis');
$fileJson =  $_SERVER['DOCUMENT_ROOT'] . '/backend/js/comps/ireport/out/'.$jrxml.'.jrxml';
$fp = fopen($fileJson, 'w');
fwrite($fp, $xml);
fclose($fp);








$input = $_SERVER['DOCUMENT_ROOT'] . '/backend/js/comps/ireport/out/'.$jrxml.'.jrxml';
$jasper = new PHPJasper;
$jasper->compile($input)->execute(); //compilar



//to pdf
$filename = 'report_pdf_'.date('YmdHis');
$input =  $_SERVER['DOCUMENT_ROOT'] . '/backend/js/comps/ireport/out/'.$jrxml.'.jasper';
$output = $_SERVER['DOCUMENT_ROOT']  . '/backend/js/comps/ireport/out/'.$filename;

$options = [
    'format' => ['pdf'],
    'params' => [
        "PERIODO" => "período",
        "CONTA" => "conta"
    ],
    'db_connection' => [
        'driver' => 'json',
        'data_file' => $_SERVER['DOCUMENT_ROOT'] . "/backend/js/comps/ireport/extrato.json",
        'json_query' => 'row'
    ]
];

$jasper->process(
    $input,
    $output,
    $options
)->execute();
/*
header('Content-type: application/pdf');
header('Content-Disposition: attachment; filename="' . $filename . '.pdf' . '"'); //inline attachment
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . filesize($file));
header('Accept-Ranges: bytes');
@readfile($file);
unlink($file);
unlink($data);*/