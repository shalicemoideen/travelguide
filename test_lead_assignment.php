<?php
/**
 * Test script for Meta lead assignment system
 * This script can be used to test the shift and language-based assignment logic
 */

// Include CodeIgniter bootstrap if needed
// require_once 'index.php';

class TestLeadAssignment 
{
    private $test_cases = [];
    
    public function __construct() 
    {
        $this->setup_test_cases();
    }
    
    private function setup_test_cases() 
    {
        $this->test_cases = [
            // Test case 1: Shift overlap period (12:30 PM - 6:30 PM)
            [
                'time' => '14:30:00', // 2:30 PM
                'description' => 'Overlap period - both shifts should be active',
                'expected_shifts' => ['shift1', 'shift2']
            ],
            
            // Test case 2: Only shift1 active
            [
                'time' => '10:30:00', // 10:30 AM
                'description' => 'Only shift1 active',
                'expected_shifts' => ['shift1']
            ],
            
            // Test case 3: Only shift2 active
            [
                'time' => '19:30:00', // 7:30 PM
                'description' => 'Only shift2 active',
                'expected_shifts' => ['shift2']
            ],
            
            // Test case 4: No shifts active
            [
                'time' => '07:30:00', // 7:30 AM
                'description' => 'No shifts active',
                'expected_shifts' => []
            ],
            
            // Test case 5: Language extraction tests
            [
                'mapped_data' => ['language' => 'Tamil'],
                'description' => 'Tamil language detection',
                'expected_language' => 'tamil'
            ],
            
            [
                'mapped_data' => ['language' => 'English'],
                'description' => 'English language detection',
                'expected_language' => 'english'
            ],
            
            [
                'mapped_data' => ['language' => 'Hindi Language'],
                'description' => 'Hindi language detection',
                'expected_language' => 'hindi'
            ],
            
            [
                'mapped_data' => [],
                'description' => 'Default language when no language specified',
                'expected_language' => 'english'
            ]
        ];
    }
    
    public function run_tests() 
    {
        echo "=== Lead Assignment System Test Results ===\n\n";
        
        foreach ($this->test_cases as $i => $test_case) {
            echo "Test " . ($i + 1) . ": " . $test_case['description'] . "\n";
            
            if (isset($test_case['time'])) {
                $this->test_shift_detection($test_case);
            } elseif (isset($test_case['mapped_data'])) {
                $this->test_language_extraction($test_case);
            }
            
            echo "\n";
        }
        
        echo "=== Test Complete ===\n";
    }
    
    private function test_shift_detection($test_case) 
    {
        $time = $test_case['time'];
        $expected = $test_case['expected_shifts'];
        
        // Simulate shift detection logic
        $active_shifts = [];
        
        // Check Shift1 (08:30 - 18:30)
        if ($time >= '08:30:00' && $time <= '18:30:00') {
            $active_shifts[] = 'shift1';
        }
        
        // Check Shift2 (12:30 - 20:30)
        if ($time >= '12:30:00' && $time <= '20:30:00') {
            $active_shifts[] = 'shift2';
        }
        
        $result = implode(', ', $active_shifts);
        $expected_str = implode(', ', $expected);
        
        echo "  Time: $time\n";
        echo "  Expected: $expected_str\n";
        echo "  Actual: $result\n";
        echo "  Status: " . ($active_shifts === $expected ? "PASS" : "FAIL") . "\n";
    }
    
    private function test_language_extraction($test_case) 
    {
        $mapped = $test_case['mapped_data'];
        $expected = $test_case['expected_language'];
        
        // Simulate language extraction logic
        $language = 'english'; // default
        
        if (isset($mapped['language'])) {
            $lang = strtolower(trim($mapped['language']));
            if ($lang === 'tamil' || $lang === 'tamil language' || strpos($lang, 'tamil') !== false) {
                $language = 'tamil';
            } elseif ($lang === 'hindi' || $lang === 'hindi language' || strpos($lang, 'hindi') !== false) {
                $language = 'hindi';
            } elseif ($lang === 'malayalam' || $lang === 'malayalam language' || strpos($lang, 'malayalam') !== false) {
                $language = 'malayalam';
            } elseif ($lang === 'english' || $lang === 'english language' || strpos($lang, 'english') !== false) {
                $language = 'english';
            }
        }
        
        echo "  Input: " . json_encode($mapped) . "\n";
        echo "  Expected: $expected\n";
        echo "  Actual: $language\n";
        echo "  Status: " . ($language === $expected ? "PASS" : "FAIL") . "\n";
    }
}

// Run tests
if (php_sapi_name() === 'cli') {
    $test = new TestLeadAssignment();
    $test->run_tests();
} else {
    echo "This script can only be run from command line.\n";
    echo "Usage: php test_lead_assignment.php\n";
}
?>
