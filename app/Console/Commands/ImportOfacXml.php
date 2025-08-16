<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Ofac\OfacXmlParser;
use App\Models\SdnEntry;
use App\Models\SdnAka;
use App\Models\SdnAddress;
use App\Models\SdnId;
use App\Models\SdnCitizenship;
use App\Models\SdnProgram;

class ImportOfacXml extends Command
{
    protected $signature = 'ofac:import';
    protected $description = 'Import OFAC SDN XML file';

    public function handle()
    {
        $this->info('Reading local SDN XML file...');
        $file = storage_path('ofac/SDN_20250815_145656.xml');

        if (!file_exists($file)) {
            $this->error("File not found: $file");
            return 1;
        }

        $xml = file_get_contents($file);
        $parser = new OfacXmlParser();
        $entries = $parser->parse($xml);

        if (count($entries) === 0) {
            $this->info("No entries were parsed from the XML.");
            return 0;
        }

        $this->info("Processing " . count($entries) . " entries...");

        foreach ($entries as $entry) {
          $sdn = SdnEntry::updateOrCreate(
              ['uid_xml' => $entry['uid'], 'list_type' => $entry['list_type']],
              [
                  'name'            => $entry['name'],
                  'entity_type'     => $entry['entity_type'],
                  'remarks'         => $entry['remarks'],
                  'source_date'     => $entry['source_date'],
                  'program_summary' => $entry['program_summary'],
              ]
          );
        
          // Programs
          $sdn->programs()->delete();
          foreach ($entry['programs'] as $p) {
              SdnProgram::create(array_merge($p, ['sdn_entry_id' => $sdn->id]));
          }
        
          // AKAs
          $sdn->akas()->delete();
          foreach ($entry['akas'] as $aka) {
              SdnAka::create(array_merge($aka, ['sdn_entry_id' => $sdn->id]));
          }
        
          // Addresses
          $sdn->addresses()->delete();
          foreach ($entry['addresses'] as $addr) {
              SdnAddress::create(array_merge($addr, ['sdn_entry_id' => $sdn->id]));
          }
        
          // IDs
          $sdn->ids()->delete();
          foreach ($entry['ids'] as $id) {
              SdnId::create(array_merge($id, ['sdn_entry_id' => $sdn->id]));
          }
        
          // Citizenships
          $sdn->citizenships()->delete();
          foreach ($entry['citizenships'] as $c) {
              SdnCitizenship::create(array_merge($c, ['sdn_entry_id' => $sdn->id]));
          }
        }

        $this->info("Import completed successfully.");
        return 0;
    }
}
