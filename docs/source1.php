<?
  require_once('inc/dbinit.php');
  require_once('inc/dbpager.php');

// ���������� ��������� ������� �� �������� (pager)

  $limit  = 4;


// ��������� ��� ����������� ����-������ � ���� �������

  function transform_thumb($field_value) {
    global $v;
    $userid = substr($field_value,2,4);

    return '<a href="admprofile.php?userid='.$v[id].'"><img border="0" src="'.$field_value.'"></a>';
  }

// ����� ������ � ���� �� ������� ���������� join

  $table_name = 'dataadmins';
  $table_name1 = 'jetpics';
  $join_field = 'id';
  $join_field1 = 'modid';

// ���� �� ��������� �� �������� ������� ����������

  $default_sort = 1;

// ��������� ���� ������ �������

  $primary_key = 'id';

//����������� 
  $field_table = array ('id'         => 'dataadmins',
						'thumb'      => 'jetpics',
						'screenname' => 'dataadmins',
						'login'      => 'dataadmins',
						'password'   => 'dataadmins',
						'pending'    => 'dataadmins');



// ��������� ����� �������

  $field_title = array ('id',
						'thumb',
						'screenname',
						'email',
						'password',
						'pending');
  
// ��������� �� �������-��������� ��� ����������� ������� ����� ������ (��������, 1,0 => Yes,No ���) 

  $decorator = array ('thumb'  => 'transform_thumb');

// ������ ������ ��������

  $col_width = array ('60','120','140','200','120','100');


// ������ ������ input'��

  $input_size = array ('4','0','15','14','10','2');


//������ ���� ����������� ��������� ���������� �����������
  $sorting = array ('1','0','1','1','1','1');


  require_once('inc/smart_table.php');
?>