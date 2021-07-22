<?php


namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Testing\TestResponse;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertEqualsCanonicalizing;

trait TestHelpers
{
    protected function assertGet(string $url, array $expectedResponseData) {
        $response = $this->jsonGet($url);
        $this->assertResponse($response, [
            'data' => $expectedResponseData
        ], 200);
    }

    protected function assertCreatePost(string $url, array $postData, array $expectedResponseData, string $tableName, array $expectedDatabaseData) {
        $this->assertPost($url, $postData, $expectedResponseData);
        $this->assertDatabaseLastRows($tableName, $expectedDatabaseData);
    }

    protected function assertPost(string $url, array $postData, array $expectedResponseData) {
        $response = $this->jsonPost($url, $postData);
        $this->assertResponse($response, [
            'data' => $expectedResponseData
        ]);
    }

    protected function assertInvalidDataPost(string $url, array $postData, array $expectedErrors)
    {
        $response = $this->jsonPost($url, $postData);
        $this->assertResponse($response, [
            'message' => 'The given data was invalid.',
            'errors' => $expectedErrors,
        ], 422);
    }

    protected function assertResponse(TestResponse $response, array $expectedResponseData, int $expectedStatusCode = 201) {
        $this->assertStatus($response, $expectedStatusCode);
        $responseContent = json_decode($response->content(), true);
        assertEquals($expectedResponseData, $responseContent);
    }

    protected function jsonGet(string $url) {
        return $this->get($url, [
            'Authorization' => 'Bearer ' . $this->getLoginToken(),
            'Content-Type' => 'multipart/form-data',
            'Accept' => 'application/json',
        ]);
    }

    protected function jsonPost(string $url, array $data) {
        return $this->post($url, $data, [
            'Authorization' => 'Bearer ' . $this->getLoginToken(),
            'Content-Type' => 'multipart/form-data',
            'Accept' => 'application/json',
        ]);
    }

    protected function assertStatus(TestResponse $response, int $expectedStatusCode = 201) {
        assertEquals($expectedStatusCode, $response->status(),
            'Invalid status code. Response content: ' . $response->content());
    }

    protected function assertDatabaseLastRows(string $tableName, array $expectedRows) {
        $rows = DB::table($tableName)
            ->orderByDesc('id')
            ->limit(count($expectedRows))
            ->get()
            ->toArray();
        $rows = array_map(function($row) {
            return (array)$row;
        }, $rows);
        $this->assertDatabaseRows($rows, $expectedRows);
    }

    protected function assertDatabaseRows(array $rows, array $expectedRows) {
        foreach ($rows as $rowKey => $row) {
            $expectedRow = $expectedRows[$rowKey];
            $correctRowValues = array_intersect_assoc($row, $expectedRow);
            assertEquals(count($expectedRow), count($correctRowValues),
                'Unexpected values in row: ' . json_encode($this->getDatabaseRowCurrentValues($row, $expectedRow)) . '. Expected: ' . json_encode($expectedRow));
        }
    }

    protected function getDatabaseRowCurrentValues(array $row, array $expectedRow) {
        $rowKeys = array_filter(array_keys($row), function($rowKey) use($expectedRow) {
            return array_key_exists($rowKey, $expectedRow);
        });
        $currentRowValues = [];
        foreach ($rowKeys as $rowKey) {
            $currentRowValues[$rowKey] = $row[$rowKey];
        }
        return $currentRowValues;
    }

}
