<?php

	//--------------------------------------Config--------------------------

	//������� ��� ���������� ������
	define('UPLOAD_DIR', $_SERVER['DOCUMENT_ROOT'] . '/clients/files/images/');
	//������������ ���������� ����� ��� ������ (��� ���) �� ������ �������� �������
	define('RANDOM_NAME', true);
	//��������� (��� ���) �������� ���������� ������
	define('ALLOW_MULTIPLE_SELECTION', false);
	//����������� ���������� ����� ������ ������������ ����� (Mb)
	define('MAXIMUM_FILESIZE', 2);
	//����������� ���������� ���-�� ����������� ������ �� ���� "������", ���� �������� 0 - ��� �����������
	define('MAXIMUM_FILECOUNT', 0);
	/*URL �� ������� �������� ����������, �� ���������� ������� ��������,
	  ����� �������� ����� JavaScript ������� �������� � ���� javascript:funcName()
	  ���� �������� ������, �� ������� �� ��������������*/
	define('URL_AFTER_UPLOAD', "");
	//� ����� ���� ��������� URL_AFTER_UPLOAD
	define('TARGET_AFTER_UPLOAD', "_self");
	//�������, ��� ������ ������������� ������������ ����� ������, �������� Images::*.jpg;*.jpeg;*.png||Media::*.mp3;*.wav
	define('FILE_FILTER', 'Images::*.jpg;*.jpeg;*.png');
	//���������� (��� ���) �������� �������
	define('TRANSFER_RATE', true);
	//���������� (��� ���) ���������� �����
	define('ESTIMATED_TIME', true);
	
	//���� � ����������� � ��������, ���� �� ������������ - ������
	define('SESSION_SAVE_PATH', 'files/sessions');
	//��� ������ - ���� �����������, ����������: PHPSESSID
	define('SESSION_NAME', 'cat3id');
?>