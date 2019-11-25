<?php

namespace App\Console\Commands;

use GraphAware\Bolt\Protocol\V1\Session;
use Illuminate\Console\Command;

class seedSomeData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seedsomedata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Session $client)
    {
        // $cypher = "CREATE (ZuzanaK:Person {name:'Zuzana K.'})
        //     CREATE (Mariam:Person {name:'Mariam'})
        //     CREATE (ZuzanaK)-[:PARENT_OF]->(Mariam)";
        // $client->run($cypher);

        // $result = $client->run('MATCH (p:Person {}) RETURN p');
        
        // foreach ($result->getRecords() as $record) {
        //     echo sprintf('Person name is : %s', $record->get('p')->value('name')) . "\n";
        // }

        $cypher = "CREATE (ZuzanaK:Person {name:'Zuzana K.'})
                    CREATE (Joe:Person {name:'Joe'})
                    CREATE (Tom:Person {name:'Tom'})";

        $client->run($cypher);

        $client->run("
                MATCH (Joe:Person),(Tom:Person),(ZuzanaK:Person)
                WHERE Joe.name = 'Joe' AND Tom.name = 'Tom' AND ZuzanaK.name = 'Zuzana K.'
                CREATE (Joe)-[r:WORKS_FOR]->(Tom), (Tom)-[q:WORKS_FOR]->(ZuzanaK), (ZuzanaK)-[s:IS_DAUGHTER_OF]->(Tom)
                RETURN r,q,s ");

        // Deleting relationship only
        // $client->run('MATCH (ZuzanaK)-[r:PARENT_OF]->() DELETE r');

        // Deleting the node and all its relationships
        // $client->run('MATCH (ZuzanaK:Person) DETACH DELETE ZuzanaK');

        // Deleting an empty node (node with no name label)
        // $client->run('MATCH (n) WHERE NOT (EXISTS (n.name)) DETACH DELETE n');

        // Delete everything
        // $client->run('MATCH (n) DETACH DELETE n');

        // Creating a new relationship
        // $client->run('CREATE (ZuzanaK)-[:MOTHER_OF]->(Mariam)');


        // Mergin a single node with a label - when label doesn't exist yet, it gets created
        $client->run('MATCH (ZuzanaK:Person)
                    MERGE (ZuzanaK)-[r:MOTHER_OF]->(Ibby)
                    RETURN r;
        ');



        // Reading a result
        // $result = $client->run('MATCH (ZuzanaK:Person) RETURN ZuzanaK');

        // // Get all records
        // $records = $result->getRecords();

        // // Get the only record
        // $record = $result->getRecord();

        // // Get the first record
        // $record = $result->firstRecord();

        // // Get record summary which contains the statement, the statistics and the QueryPlan, if available
        // $record = $result->summarize();
        // $query = $record->statement()->text();
        // $stats = $record->updateStatistics();

        // dd($records);

        // Cypher statements and stacks
        // Create a $stack, push statements to the stack, run all statements at once by running the stack
        // $stack = $client->stack();
        // $stack->push('CREATE (n:Person {name: ZuzanaK})');
        // $stack->push('CREATE (n:Person {name: MariamA})');
        // $stack->push('MATCH (n:Person {name: ZuzanaK}), (n2:Person {name: MariamA}) MERGE (n)-[:DAUGHTER_OF]->(n2)');
        // $client->runStack($stack);
    }
}
