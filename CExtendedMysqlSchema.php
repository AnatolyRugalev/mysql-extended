<?php
YiiBase::import('ext.MysqlExtended.*');

class CExtendedMysqlSchema extends CMysqlSchema
{
	/**
	 * Collects the foreign key column details for the given table.
	 * @param CExtendedMysqlTableSchema $table the table metadata
	 */
	protected function findConstraints($table)
	{
		$row=$this->getDbConnection()->createCommand('SHOW CREATE TABLE '.$table->rawName)->queryRow();
		$matches=array();
		$regexp='/FOREIGN KEY\s+\(([^\)]+)\)\s+REFERENCES\s+([^\(^\s]+)\s*\(([^\)]+)\)/mi';
		$engineMatches=array();
		$engineRegexp='/CREATE TABLE\s+[^\s^\(]+\s+\(.*\)\s+ENGINE=([^\s^\(]+)/is';
		foreach($row as $sql)
		{
			if(preg_match_all($regexp,$sql,$matches,PREG_SET_ORDER))
			{
				if(preg_match($engineRegexp, $sql, $engineMatches) && isset($engineMatches[1]))
					$table->engine=$engineMatches[1];
				break;
			}
		}
		foreach($matches as $match)
		{
			$keys=array_map('trim',explode(',',str_replace(array('`','"'),'',$match[1])));
			$fks=array_map('trim',explode(',',str_replace(array('`','"'),'',$match[3])));
			foreach($keys as $k=>$name)
			{
				$table->foreignKeys[$name]=array(str_replace(array('`','"'),'',$match[2]),$fks[$k]);
				if(isset($table->columns[$name]))
					$table->columns[$name]->isForeignKey=true;
			}
		}
	}

}
