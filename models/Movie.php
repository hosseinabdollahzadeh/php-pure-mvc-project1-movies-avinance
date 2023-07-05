<?php
/**
 * User: TheCodeholic
 * Date: 7/8/2020
 * Time: 9:15 AM
 */

namespace app\models;


use PDO;
use thecodeholic\phpmvc\db\DbModel;

/**
 * Class Register
 *
 * @author  Zura Sekhniashvili <zurasekhniashvili@gmail.com>
 * @package app\models
 */
class Movie extends DbModel
{
    public int $id = 0;
    public string $title_fa = '';
    public string $title_en = '';
    public string $movie_url = '';
    public string $description_fa = '';
    public string $description_en = '';

    public static function tableName(): string
    {
        return 'movies';
    }

    private static function findAll()
    {
    }

    public function attributes(): array
    {
        return ['title_fa', 'title_en', 'user_id', 'movie_url', 'description_fa', 'description_en'];
    }

    public function labels(): array
    {
        return [
            'title_fa' => 'Farsi Title',
            'title_en' => 'English Title',
            'movie_url' => 'Movie URL',
            'description_fa' => 'Farsi Description',
            'description_en' => 'English Description'
        ];
    }

    public function rules()
    {
        return [
            'title_fa' => [self::RULE_REQUIRED],
            'title_en' => [self::RULE_REQUIRED],
            'user_id' => [self::RULE_REQUIRED],
            'movie_url' => [self::RULE_REQUIRED],
            'description_fa' => [self::RULE_REQUIRED],
            'description_en' => [self::RULE_REQUIRED]
        ];
    }

//    public function save()
//    {
//        return parent::save();
//    }

    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);

        if ($this->isNewRecord()) {
            // Insert new model
            $statement = self::prepare("INSERT INTO $tableName (" . implode(",", $attributes) . ") 
            VALUES (" . implode(",", $params) . ")");
        } else {
            // Update existing model
            $primaryKey = 'id';
            $updateFields = array_map(fn($attr) => "$attr=:$attr", $attributes);
            $statement = self::prepare("UPDATE $tableName SET " . implode(",", $updateFields) . " WHERE $primaryKey = :$primaryKey");
            $statement->bindValue(":$primaryKey", $this->{$primaryKey});
        }

        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }

        $statement->execute();
        return true;
    }

    public function isNewRecord()
    {
        return empty($this->id);
    }

    public function delete()
    {
        // Check if the movie has an ID
        if ($this->id === 0) {
            return false; // Return false if no ID is set
        }

        $tableName = $this->tableName();

        // Prepare and execute the DELETE query
        $statement = self::prepare("DELETE FROM $tableName WHERE id = :id");
        $statement->bindValue(':id', $this->id);
        $statement->execute();

        return true;
    }


    public static function getAll($offset, $limit)
    {
        $sql = "SELECT * FROM movies LIMIT :offset, :limit";

        $stmt = self::prepare($sql);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();


        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public
    static function countAll()
    {
        $sql = "SELECT COUNT(*) as count FROM movies";

        $stmt = self::prepare($sql);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }

}