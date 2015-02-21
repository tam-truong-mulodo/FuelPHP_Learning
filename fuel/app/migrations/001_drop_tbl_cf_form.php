<?php

namespace Fuel\Migrations;

class Drop_tbl_cf_form
{
	public function up()
	{
		\DBUtil::drop_table('tbl_cf_form');
	}

	public function down()
	{
		\DBUtil::create_table('tbl_cf_form', array(
			'id' => array('type' => 'int unsigned', 'null' => true, 'constraint' => 10, 'auto_increment' => true),
			'name' => array('type' => 'varchar', 'null' => true, 'constraint' => 50),
			'email' => array('type' => 'varchar', 'null' => true, 'constraint' => 100),
			'comment' => array('type' => 'varchar', 'null' => true, 'constraint' => 400),
			'ip_address' => array('type' => 'varchar', 'null' => true, 'constraint' => 39),
			'user_agent' => array('type' => 'varchar', 'null' => true, 'constraint' => 512),
			'created_at' => array('type' => 'timestamp', 'default' => 'CURRENT_TIMESTAMP'),
			'updated_at' => array('type' => 'timestamp', 'default' => 'CURRENT_TIMESTAMP'),

		), array('id'));

	}
}