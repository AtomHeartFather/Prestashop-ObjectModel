<?php
/**
 * Имя(может различаться в разных языках)
 * Дата рождения
 * Учиться\отчислен
 * Средний бал
 *
 * Получить список всех учеников
 * Получить лучшего ученика по среднему балу
 * Получить самый высокий средний бал
*/
class Student extends ObjectModel
{

    public $id;

    public $name;

    public $birth_date;

    public $active;

    public $average_score;

    public static $definition = array(
        'table' => 'student',
        'primary' => 'id_student',
        'multilang' => true,
        'fields' => array(
            'name' => array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName', 'required' => true, 'size' => 64),
            'birth_date' => array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
            'active' => array('type' => self::TYPE_BOOL, 'validate' => 'isBool'),
            'average_score' => array('type' => self::TYPE_FLOAT, 'validate' => 'isFloat'),
        ),
    );

    public static function getAllNames()
    {
        $sql = new DbQuery();
        $sql->select('name');
        $sql->from('student');
        return Db::getInstance()->executeS($sql);
    }

    public static function getBestAverageScoreStudent()
    {
        $sql = 'SELECT `name` FROM `student` WHERE `average_score` = (SELECT MAX(`average_score`) FROM `student`)';
        return Db::getInstance()->executeS($sql);
    }

    public static function getMaxAverageScore()
    {
        $sql = 'SELECT MAX(`average_score`) FROM `student`';
        return Db::getInstance()->executeS($sql);
    }

}
