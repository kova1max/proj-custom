<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if (!function_exists("__MPF_ImageResizeHandler"))
{
	function __MPF_ImageResizeHandler(&$arCustomFile)
	{
		$arResizeParams = array("width" => 400, "height" => 400);

		if ((!is_array($arCustomFile)) || !isset($arCustomFile['fileID']))
			return false;

		$fileID = $arCustomFile['fileID'];

		$arFile = CFile::MakeFileArray($fileID);
		if (CFile::CheckImageFile($arFile) === null)
		{
			$aImgThumb = CFile::ResizeImageGet(
				$fileID,
				array("width" => 90, "height" => 90),
				BX_RESIZE_IMAGE_EXACT,
				true
			);
			$arCustomFile['img_thumb_src'] = $aImgThumb['src'];

			if (!empty($arResizeParams))
			{
				$aImgSource = CFile::ResizeImageGet(
					$fileID,
					array("width" => $arResizeParams["width"], "height" => $arResizeParams["height"]),
					BX_RESIZE_IMAGE_PROPORTIONAL,
					true
				);
				$arCustomFile['img_source_src'] = $aImgSource['src'];
				$arCustomFile['img_source_width'] = $aImgSource['width'];
				$arCustomFile['img_source_height'] = $aImgSource['height'];
			}
		}

	}
}

if (!empty($arParams["UPLOAD_FILE_PARAMS"]))
{
	$bNull = null;
	__MPF_ImageResizeHandler($bNull, $arParams["UPLOAD_FILE_PARAMS"]);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_REQUEST['mfi_mode']) && ($_REQUEST['mfi_mode'] == "upload"))
{
	AddEventHandler('main',  "main.file.input.upload", '__MPF_ImageResizeHandler');
}

if(!function_exists('GetUserField')) {
function GetUserField ($entity_id, $value_id, $property_id) 
{ 
   $arUF = $GLOBALS["USER_FIELD_MANAGER"]->GetUserFields ($entity_id, $value_id); 
   return $arUF[$property_id]["VALUE"]; 
} 
}
?>