<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Type;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190803113237 extends AbstractMigration
{
    /**
     * @return string
     */
    public function getDescription() : string
    {
        return 'Create users table';
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema) : void
    {
        $table = $schema->createTable('users');
        $table->addColumn('id', Type::INTEGER, [ 'autoincrement' => true]);
        $table->addColumn('user_name', Type::STRING, []);
        $table->addColumn('email', Type::STRING, []);
        $table->setPrimaryKey(['id']);
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema) : void
    {
       $schema->dropTable('users');
    }
}
