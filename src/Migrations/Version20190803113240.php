<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Type;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190803113240 extends AbstractMigration
{
    /**
     * @return string
     */
    public function getDescription() : string
    {
        return 'Create invitations table';
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function up(Schema $schema) : void
    {
        $table = $schema->createTable('invitations');
        $table->addColumn('id', Type::INTEGER, [ 'autoincrement' => true ]);
        $table->addColumn('user_sender_id', Type::INTEGER, []);
        $table->addColumn('user_invited_id', Type::INTEGER, []);
        $table->addColumn('state', Type::INTEGER, [ 'default' => 0 ]);
        $table->setPrimaryKey(['id']);

        $fk = $schema->getTable('users');
        $table->addForeignKeyConstraint($fk, ['user_sender_id'], ['id'], ['cascade' => 'all'], 'fk_user_sender');
        $table->addForeignKeyConstraint($fk, ['user_invited_id'], ['id'], ['cascade' => 'all'], 'fk_user_invited');
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function down(Schema $schema) : void
    {
        $table = $schema->getTable('invitations');
        $table->removeForeignKey('fk_user_sender');
        $table->removeForeignKey('fk_user_invited');

        $schema->dropTable('invitations');
    }
}
