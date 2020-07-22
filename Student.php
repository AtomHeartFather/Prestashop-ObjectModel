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

    public static function getAllNames($idLang)
    {
        $sql = 'SELECT l.`name` FROM `'._DB_PREFIX_.'student` c LEFT JOIN `'._DB_PREFIX_.'student_lang` l on l.`id_student` = c.`id_student` WHERE l.`id_lang` = '.(int) $idLang.''
        return Db::getInstance()->executeS($sql);
    }

    public static function getBestAverageScoreStudent($idLang)
    {
        $sql = 'SELECT l.`name` FROM `'._DB_PREFIX_.'student` c LEFT JOIN `'._DB_PREFIX_.'student_lang` l on l.`id_student` = c.`id_student` WHERE c.`average_score` = (SELECT MAX(`average_score`) FROM `'._DB_PREFIX_.'student`) AND l.`id_lang` = '.(int) $idLang.'';
        return Db::getInstance()->executeS($sql);
    }

    public static function getMaxAverageScore()
    {
        $sql = 'SELECT MAX(`average_score`) FROM `student`';
        return Db::getInstance()->executeS($sql);
    }

}
