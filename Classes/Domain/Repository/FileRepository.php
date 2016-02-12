<?php
namespace AndreasWolf\Modernfilelist\Domain\Repository;

use TYPO3\CMS\Core\Database\DatabaseConnection;
use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Resource\ResourceStorage;


class FileRepository
{

    /**
     * @param ResourceStorage $storage
     * @param string $path
     * @return File[]
     */
    public function getByPath(ResourceStorage $storage, $path)
    {
        $folder = $storage->getFolder($path);

        return $folder->getFiles();
    }

    /**
     * @param int[] $fileUids The files to count relations for
     * @return int[] The relation count, indexed by uid
     */
    public function countRelations($fileUids)
    {
        $query = 'SELECT ri.ref_uid AS file_id, COUNT(*) AS count
            FROM sys_refindex ri
            WHERE ri.ref_table = "sys_file" AND ri.tablename != "sys_file_metadata" AND ri.deleted = 0 AND ri.ref_uid IN (%s)
            GROUP BY ri.ref_uid';
        $uidsString = implode(',', $fileUids);

        $conn = $this->getDatabaseConnection();

        $referenceCount = array_fill_keys($fileUids, 0);
        $result = $conn->sql_query(sprintf($query, $uidsString));
        while ($row = $conn->sql_fetch_assoc($result)) {
            $referenceCount[$row['file_id']] = $row['count'];
        }

        return $referenceCount;
    }

    /**
     * @return DatabaseConnection
     */
    protected function getDatabaseConnection()
    {
        return $GLOBALS['TYPO3_DB'];
    }
}
