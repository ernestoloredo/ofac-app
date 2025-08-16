<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use SimpleXMLElement;

class DebugOfacXml extends Command
{
    protected $signature = 'debug:ofac';
    protected $description = 'Debug OFAC XML structure';

    public function handle()
    {
        $file = storage_path('ofac/SDN_20250815_145656.xml');

        if (!file_exists($file)) {
            $this->error("File not found: $file");
            return 1;
        }

        $xml = file_get_contents($file);
        $sx = new SimpleXMLElement($xml);

        // Show namespaces
        $ns = $sx->getNamespaces(true);
        $this->info("Namespaces: " . implode(', ', array_keys($ns)));

        // List top-level children
        foreach ($sx->children($ns[''] ?? null) as $child) {
            $this->line("Top child: " . $child->getName());

            foreach ($child->children($ns[''] ?? null) as $grand) {
                $this->line("  Grandchild: " . $grand->getName());
            }
        }

        return 0;
    }
}
