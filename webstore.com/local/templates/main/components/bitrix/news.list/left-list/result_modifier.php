<?

$arFilter = array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ACTIVE' => 'Y', 'CNT_ACTIVE'=>'Y'); 
$rsSection = CIBlockSection::GetList(array("left_margin"=>"asc"), $arFilter, true, array());

$i = 1;
while($arSection = $rsSection->GetNext()){
    $arResult['SECTIONS'][$arSection['ID']] = array(
        'ID' => $arSection['ID'],
        'LIST_PAGE_URL'=>$arSection['LIST_PAGE_URL'],
        'SECTION_PAGE_URL' => $arSection['SECTION_PAGE_URL'],
        'NAME' => $arSection['NAME'],
        'ELEMENT_CNT' => $arSection['ELEMENT_CNT'],
        'DEPTH_LEVEL' => $arSection['DEPTH_LEVEL'],
        'IBLOCK_ID' => $arSection['IBLOCK_ID'],
        'LEFT_MARGIN' => $arSection['LEFT_MARGIN'],
        'RIGHT_MARGIN' => $arSection['RIGHT_MARGIN'],
        'TAB_ID' => $arSection['DEPTH_LEVEL'] == 1 ? $i : ''
    );

    if($arSection['DEPTH_LEVEL'] == 1){
        $i++;
    }
}

foreach($arResult['SECTIONS'] as $id => $SEC) {

    $tmp = CIBlockSection::GetList(
        array('left_margin' => 'asc'),
        array(
            'IBLOCK_ID' => $SEC['IBLOCK_ID'],
            '>LEFT_MARGIN' => $SEC['LEFT_MARGIN'],
            '<RIGHT_MARGIN' => $SEC['RIGHT_MARGIN'],
            '>DEPTH_LEVEL' => $SEC['DEPTH_LEVEL']
        )
    );

    while ($arSect = $tmp->GetNext()) {
        $arResult['SECTIONS'][$id]['CHILDREN'][$arSect['ID']] = array(
            'ID' => $arSect['ID'],
            'NAME' => $arSect['NAME']
        );
    }

}

$first_section=reset($arResult['SECTIONS']);

if( $APPLICATION->GetCurDir() == $first_section['LIST_PAGE_URL'] ) {
    LocalRedirect($first_section['SECTION_PAGE_URL']);
} else {
    preg_match('~/[a-z]+/[a-z]+[/]~', $APPLICATION->sDirPath, $_REQUEST['SECTION']);

}


?>