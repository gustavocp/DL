<?php

class m120826_092147_Migrate_Database extends CDbMigration
{
	public function safeUp()
	{

/*		$this->dropForeignKey('FK_admin_user_role', 'admin_user');
		$this->dropIndex('FK_admin_user_role',	'admin_user');
		$this->dropTable('role');
*/		
		$this->createTable('authitem',
								array
								(
									'name' => 'varchar(64) NOT NULL',
									'type' => 'INT(11) NOT NULL',
									'description' => 'text',						
									'bizrule' => 'text',
									'data' => 'text',
									'PRIMARY KEY (name)',
								)
							);
		$this->createTable('authassignment',
							array
							(
							  'itemname' => 'varchar(64) NOT NULL',
							  'userid' => 'mediumint(8) unsigned NOT NULL',
							  'bizrule' => 'text',
							  'data' => 'text',
							  'PRIMARY KEY (itemname,userid)',
							  'KEY FK_authassignment_admin_user (userid)',
							  'CONSTRAINT authassignment_ibfk_1 FOREIGN KEY (itemname) REFERENCES authitem (name) ON DELETE CASCADE ON UPDATE CASCADE',
							  'CONSTRAINT FK_authassignment_admin_user FOREIGN KEY (userid) REFERENCES admin_user (id) ON DELETE CASCADE ON UPDATE CASCADE'
							
							)
						  	
						  );
		$this->createTable('authitemchild',
							array
							(
							  'parent' => 'varchar(64) NOT NULL',
							  'child' => 'varchar(64) NOT NULL',
							  'PRIMARY KEY (parent, child)',
							  'KEY child (child)',
							  'CONSTRAINT authitemchild_ibfk_1 FOREIGN KEY (parent) REFERENCES authitem (name) ON DELETE CASCADE ON UPDATE CASCADE',
							  'CONSTRAINT authitemchild_ibfk_2 FOREIGN KEY (child) REFERENCES authitem (name) ON DELETE CASCADE ON UPDATE CASCADE'
							
							)
						  	
						  );
						  

	}
}