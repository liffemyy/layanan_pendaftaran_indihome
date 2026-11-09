<?php

namespace App\Libraries;

use Google\Client;
use Google\Service\Sheets;
use Google\Service\Sheets\ValueRange;

class GoogleSheetService
{
    private $service;
    private $spreadsheetId;

    public function __construct()
    {
        $client = new Client();
        $client->setApplicationName('IndiHome Sheets Sync');
        $client->setScopes([Sheets::SPREADSHEETS]);
        $client->setAuthConfig(WRITEPATH . 'credentials/google-sheets.json');

        $this->service = new Sheets($client);
        $this->spreadsheetId = getenv('google.spreadsheetId');
    }

  public function tambahBaris(array $data)
{
    // Ubah semua null jadi string kosong, biar nggak bikin array "bolong"
    $data = array_map(function ($item) {
        return $item ?? '';
    }, $data);

    $data = array_values($data);

    $range = 'Sheet1!A1';

    $body = new ValueRange();
    $body->setValues([$data]);

    $params = [
        'valueInputOption' => 'RAW'
    ];

    $this->service->spreadsheets_values->append(
        $this->spreadsheetId,
        $range,
        $body,
        $params
    );
}
}