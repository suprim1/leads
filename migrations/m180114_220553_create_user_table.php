<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m180114_220553_create_user_table extends Migration {

    /**
     * @inheritdoc
     */
    public function safeUp() {
        /* Теблица Users */
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'login' => $this->string()->notNull(),
            'hash' => $this->string(),
            'reg' => $this->boolean()->defaultValue(0),
        ]);
        $this->createIndex(
                'idx-users-login', 'users', 'login'
        );
        $this->createIndex(
                'idx-users-hash', 'users', 'hash'
        );

        $this->createTable('api', [
            'id' => $this->primaryKey(),
            'id_user' => $this->integer()->notNull(),
            'api_key' => $this->string(),
            'name' => $this->string()->notNull(),
            'money' => $this->integer(),
        ]);
        $this->createIndex(
                'idx-api-id_user', 'api', 'id_user'
        );
        $this->createIndex(
                'idx-api-api_key', 'api', 'api_key'
        );
        $this->addForeignKey(
                'fk-api-id_user', 'api', 'id_user', 'users', 'id', 'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown() {
        $this->dropForeignKey(
                'fk-cfk-api-id_user', 'api'
        );
        /* Удаление таблицы Users */
        $this->dropIndex(
                'idx-users-login', 'users'
        );
        $this->dropIndex(
                'idx-users-hash', 'users'
        );
        $this->dropTable('users');
    }

}
