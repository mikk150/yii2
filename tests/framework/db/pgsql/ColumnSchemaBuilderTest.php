<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yiiunit\framework\db\pgsql;

use yii\db\ColumnSchemaBuilder;
use yii\db\Expression;
use yii\db\Schema;

/**
 * ColumnSchemaBuilderTest tests ColumnSchemaBuilder for Oracle.
 * @group db
 * @group pgsql
 */
class ColumnSchemaBuilderTest extends \yiiunit\framework\db\ColumnSchemaBuilderTest
{
    public $driverName = 'pgsql';

    /**
     * @param string $type
     * @param int $length
     * @return ColumnSchemaBuilder
     */
    public function getColumnSchemaBuilder($type, $length = null)
    {
        return new ColumnSchemaBuilder($type, $length, $this->getConnection());
    }

    /**
     * @return array
     */
    public function typesProvider()
    {
        return [
            ['integer NULL DEFAULT NULL', Schema::TYPE_INTEGER, null, [
                ['unsigned'], ['null'],
            ]],
            ['integer(10)', Schema::TYPE_INTEGER, 10, [
                ['unsigned'],
            ]],
            ['timestamp() WITH TIME ZONE NOT NULL', 'timestamp() WITH TIME ZONE', null, [
                ['notNull'],
            ]],
            ['timestamp() WITH TIME ZONE DEFAULT NOW()', 'timestamp() WITH TIME ZONE', null, [
                ['defaultValue', new Expression('NOW()')],
            ]],
            ['integer(10)', Schema::TYPE_INTEGER, 10, [
                ['comment', 'test'],
            ]],
            ['json', Schema::TYPE_JSON, null, []],
        ];
    }
}
