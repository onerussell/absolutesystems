<?php

	//--------------------------------------Config--------------------------

	//каталог для сохранения файлов
	define('UPLOAD_DIR', $_SERVER['DOCUMENT_ROOT'] . '/clients/files/images/');
	//генерировать уникальные имена для файлов (или нет) на основе текущего времени
	define('RANDOM_NAME', true);
	//разрешить (или нет) загрузку нескольких файлов
	define('ALLOW_MULTIPLE_SELECTION', false);
	//максимально допустимый объем одного загружаемого файла (Mb)
	define('MAXIMUM_FILESIZE', 2);
	//максимально допустимое кол-во загружаемых файлов за одну "сессию", если значение 0 - нет ограничений
	define('MAXIMUM_FILECOUNT', 0);
	/*URL на который перейдет приложение, по завершении успеной загрузки,
	  можно задавать вызов JavaScript функции страницы в виде javascript:funcName()
	  если значение пустое, то переход не осуществляется*/
	define('URL_AFTER_UPLOAD', "");
	//в каком окне открывать URL_AFTER_UPLOAD
	define('TARGET_AFTER_UPLOAD', "_self");
	//фильтры, для выбора пользователем определенных типов файлов, например Images::*.jpg;*.jpeg;*.png||Media::*.mp3;*.wav
	define('FILE_FILTER', 'Images::*.jpg;*.jpeg;*.png');
	//отображать (или нет) скорость закачки
	define('TRANSFER_RATE', true);
	//отображать (или нет) оставшееся время
	define('ESTIMATED_TIME', true);
	
	//Путь к дирректории с сессиями, если не используется - пустой
	define('SESSION_SAVE_PATH', 'files/sessions');
	//Имя сессии - если стандартное, установить: PHPSESSID
	define('SESSION_NAME', 'cat3id');
?>