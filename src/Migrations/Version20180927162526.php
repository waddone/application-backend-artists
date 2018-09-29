<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180927162526 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('
                CREATE TABLE artists (
                id INT(11) UNSIGNED AUTO_INCREMENT NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                token VARCHAR(6) NOT NULL, 
                PRIMARY KEY(id)) DEFAULT CHARACTER 
                SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('
                CREATE TABLE albums (
                id INT(11) UNSIGNED AUTO_INCREMENT NOT NULL, 
                artist_token VARCHAR(6) NOT NULL, 
                title VARCHAR(255) NOT NULL, 
                cover VARCHAR(255) NOT NULL, 
                token VARCHAR(6) NOT NULL, 
                description LONGTEXT NOT NULL,  
                PRIMARY KEY(id)) DEFAULT CHARACTER 
                SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('
            CREATE TABLE songs (
                id INT(11) UNSIGNED AUTO_INCREMENT NOT NULL,
                album_token VARCHAR(6) NOT NULL, 
                title VARCHAR(255) NOT NULL, 
                length INT NOT NULL,  
                PRIMARY KEY(id)) DEFAULT CHARACTER 
                SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('DROP TABLE albums');
        $this->addSql('DROP TABLE artists');
        $this->addSql('DROP TABLE songs');

    }
}
