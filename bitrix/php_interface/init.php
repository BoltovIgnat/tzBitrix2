<?
// файл /bitrix/php_interface/init.php
// регистрируем обработчик
AddEventHandler("iblock", "OnAfterIBlockElementUpdate", Array("iBlockEventsIB", "OnAfterIBlockElementUpdateHandler"));
AddEventHandler("iblock", "OnAfterIBlockSectionUpdate", Array("iBlockEventsIB", "OnAfterIBlockSectionUpdateHandler"));

class iBlockEventsIB
{
    // создаем обработчик события "OnAfterIBlockElementUpdate"
    function OnAfterIBlockElementUpdateHandler(&$arFields)
    {
        if($arFields["RESULT"])
            AddMessage2Log("Запись с кодом ".$arFields["ID"]." изменена.");
        else
            AddMessage2Log("Ошибка изменения записи ".$arFields["ID"]." (".$arFields["RESULT_MESSAGE"].").");
    }

    // создаем обработчик события "OnAfterIBlockSectionUpdate"
    function OnAfterIBlockSectionUpdateHandler(&$arFields)
    {
        global $USER;
        if(!is_object($USER)){
        $USER = new CUser();
        }
        CModule::IncludeModule('iblock');
        
        if($arFields["RESULT"])
            if($arFields[UF_ARCHIVE]){
                $nameSectionBackUp = $arFields[NAME] . date("Y-m-d H:i:s");
                
                $bs = new CIBlockSection;
                $arFieldsSection = Array(
                    "ACTIVE" => $arFields[ACTIVE],
                    "IBLOCK_ID" => 5,
                    "NAME" => $nameSectionBackUp,
                    "SORT" => $arFields[SORT],
                    "DESCRIPTION" => $arFields[DESCRIPTION],
                    "DESCRIPTION_TYPE" => $arFields[DESCRIPTION_TYPE]
                );

                $IDSectionBackUp = $bs->Add($arFieldsSection);

                $arSelect = Array();
                $arFilter = Array("IBLOCK_ID"=>4, "SECTION_ID"=>$arFields[ID]);
                $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);

                while($ob = $res->GetNextElement()){
                    $arFieldsBackUp = $ob->GetFields(); 
                    $arPropsBackUp = $ob->GetProperties();

                    $el = new CIBlockElement;
                    
                    $arLoadProductArray = Array(  
                        'MODIFIED_BY' => $USER->GetID(), // элемент изменен текущим пользователем  
                        'IBLOCK_SECTION_ID' => $IDSectionBackUp,   
                        'IBLOCK_ID' => 5,
                        'PROPERTY_VALUES' => array(
                            "MARKA" => $arPropsBackUp[MARKA][VALUE], 
                            "MODEL" => $arPropsBackUp[MODEL][VALUE], 
                            "PHOTO" => $arPropsBackUp[PHOTO][VALUE] 
                            ),  
                        'NAME' => $arFieldsBackUp[NAME]." - архивная копия от ".date("Y-m-d"),  
                        'ACTIVE' => 'Y',  
                    );

                    $PRODUCT_ID = $el->Add($arLoadProductArray);
                    AddMessage2Log('$arProps = '.print_r($arPropsBackUp, true),'');  
                }

                AddMessage2Log('$arFields = '.print_r($arFields, true),'');
            }else{
                AddMessage2Log('Bolt');
            }
            
        else
            AddMessage2Log("Ошибка изменения записи ".$arFields["ID"]." (".$arFields["RESULT_MESSAGE"].").");
    }
}
?>