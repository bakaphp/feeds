<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class Feedwall extends AbstractMigration
{
    public function change()
    {
        $this->execute("ALTER DATABASE CHARACTER SET 'utf8';");
        $this->execute("ALTER DATABASE COLLATE='utf8_general_ci';");
        $this->table("app_module_messages", [
                'id' => false,
                'primary_key' => ['id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'Dynamic',
            ])
            ->addColumn('id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('apps_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'signed' => false,
                'after' => 'id',
            ])
            ->addColumn('companies_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'signed' => false,
                'after' => 'apps_id',
            ])
            ->addColumn('system_modules_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_TINY,
                'precision' => '3',
                'signed' => false,
                'after' => 'companies_id',
            ])
            ->addColumn('entity_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'signed' => false,
                'after' => 'system_modules_id',
            ])
            ->addColumn('messages_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'signed' => false,
                'after' => 'entity_id',
            ])
            ->addColumn('message_types_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_TINY,
                'precision' => '3',
                'signed' => false,
                'after' => 'messages_id',
            ])
            ->create();
        $this->table("media_resources", [
                'id' => false,
                'primary_key' => ['id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'Dynamic',
            ])
            ->addColumn('id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('name', 'string', [
                'null' => true,
                'limit' => 32,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'id',
            ])
            ->addColumn('icon', 'string', [
                'null' => true,
                'limit' => 32,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'name',
            ])
            ->create();
        $this->table("mentions", [
                'id' => false,
                'primary_key' => ['id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'Dynamic',
            ])
            ->addColumn('id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('users_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'after' => 'id',
            ])
            ->addColumn('messages_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'after' => 'users_id',
            ])
            ->addColumn('comments_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'after' => 'messages_id',
            ])
            ->create();
        $this->table("message_comments", [
                'id' => false,
                'primary_key' => ['id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'Dynamic',
            ])
            ->addColumn('id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('apps_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'after' => 'id',
            ])
            ->addColumn('companies_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'after' => 'apps_id',
            ])
            ->addColumn('messages_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'after' => 'companies_id',
            ])
            ->addColumn('users_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'after' => 'messages_id',
            ])
            ->addColumn('content', 'text', [
                'null' => true,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'users_id',
            ])
            ->addColumn('reactions_count', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'after' => 'content',
            ])
            ->create();
        $this->table("message_reactions", [
                'id' => false,
                'primary_key' => ['id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'Dynamic',
            ])
            ->addColumn('id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('messages_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'after' => 'id',
            ])
            ->addColumn('comments_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'after' => 'messages_id',
            ])
            ->addColumn('user_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'after' => 'comments_id',
            ])
            ->addColumn('reactions_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'after' => 'user_id',
            ])
            ->create();
        $this->table("message_reactions_stats", [
                'id' => false,
                'primary_key' => ['id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'Dynamic',
            ])
            ->addColumn('id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('messages_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'after' => 'id',
            ])
            ->addColumn('comments_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'after' => 'messages_id',
            ])
            ->addColumn('reactions_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'after' => 'comments_id',
            ])
            ->addColumn('total', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_SMALL,
                'precision' => '5',
                'after' => 'reactions_id',
            ])
            ->create();
        $this->table("message_resources", [
                'id' => false,
                'primary_key' => ['id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'Dynamic',
            ])
            ->addColumn('id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('apps_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'after' => 'id',
            ])
            ->addColumn('companies_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'after' => 'apps_id',
            ])
            ->addColumn('messages_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'after' => 'companies_id',
            ])
            ->addColumn('comments_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'after' => 'messages_id',
            ])
            ->addColumn('media_resources_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'after' => 'comments_id',
            ])
            ->create();
        $this->table("message_tags", [
                'id' => false,
                'primary_key' => ['id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'Dynamic',
            ])
            ->addColumn('id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('messages_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'signed' => false,
                'after' => 'id',
            ])
            ->addColumn('tags_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'signed' => false,
                'after' => 'messages_id',
            ])
            ->addColumn('users_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'signed' => false,
                'after' => 'tags_id',
            ])
            ->create();
        $this->table("message_types", [
                'id' => false,
                'primary_key' => ['id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'Dynamic',
            ])
            ->addColumn('id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('apps_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'after' => 'id',
            ])
            ->addColumn('languages_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_SMALL,
                'precision' => '5',
                'after' => 'apps_id',
            ])
            ->addColumn('name', 'string', [
                'null' => true,
                'limit' => 64,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'languages_id',
            ])
            ->addColumn('template', 'text', [
                'null' => true,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'name',
            ])
            ->addColumn('template_plural', 'text', [
                'null' => true,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'template',
            ])
            ->create();
        $this->table("message_variables", [
                'id' => false,
                'primary_key' => ['id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'Dynamic',
            ])
            ->addColumn('id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('messages_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'signed' => false,
                'after' => 'id',
            ])
            ->addColumn('variable', 'string', [
                'null' => true,
                'limit' => 32,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'messages_id',
            ])
            ->addColumn('value', 'string', [
                'null' => true,
                'limit' => 64,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'variable',
            ])
            ->create();
        $this->table("messages", [
                'id' => false,
                'primary_key' => ['id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'Dynamic',
            ])
            ->addColumn('id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('app_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'signed' => false,
                'after' => 'id',
            ])
            ->addColumn('companies_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'signed' => false,
                'after' => 'app_id',
            ])
            ->addColumn('users_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'signed' => false,
                'after' => 'companies_id',
            ])
            ->addColumn('message_types_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'signed' => false,
                'after' => 'users_id',
            ])
            ->addColumn('content', 'text', [
                'null' => true,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'message_types_id',
            ])
            ->addColumn('reactions_count', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_TINY,
                'precision' => '3',
                'after' => 'content',
            ])
            ->addColumn('comments_count', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_TINY,
                'precision' => '3',
                'after' => 'reactions_count',
            ])
            ->create();
        $this->table("reactions", [
                'id' => false,
                'primary_key' => ['id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'Dynamic',
            ])
            ->addColumn('id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('name', 'string', [
                'null' => true,
                'limit' => 64,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'id',
            ])
            ->addColumn('title', 'string', [
                'null' => true,
                'limit' => 64,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'name',
            ])
            ->create();
        $this->table("system_modules", [
                'id' => false,
                'primary_key' => ['id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'Dynamic',
            ])
            ->addColumn('id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('apps_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'after' => 'id',
            ])
            ->addColumn('parent_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'after' => 'apps_id',
            ])
            ->addColumn('name', 'string', [
                'null' => true,
                'limit' => 64,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'parent_id',
            ])
            ->addColumn('slug', 'string', [
                'null' => true,
                'limit' => 64,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'name',
            ])
            ->addColumn('model_name', 'string', [
                'null' => true,
                'limit' => 64,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'slug',
            ])
            ->addColumn('order', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_TINY,
                'precision' => '3',
                'after' => 'model_name',
            ])
            ->create();
        $this->table("tags", [
                'id' => false,
                'primary_key' => ['id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'Dynamic',
            ])
            ->addColumn('id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('apps_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'after' => 'id',
            ])
            ->addColumn('companies_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'after' => 'apps_id',
            ])
            ->addColumn('users_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'precision' => '10',
                'after' => 'companies_id',
            ])
            ->addColumn('name', 'string', [
                'null' => true,
                'limit' => 32,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'users_id',
            ])
            ->create();
    }
}
