<?php
namespace AdminUI\AdminUIAddress\Database\Seeds;

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class StatesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('states')->delete();

        \DB::table('states')->insert(
            array (
                array(
                    'id' => '1',
                    'name' => 'Alabama',
                    'code' => 'AL',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '2',
                    'name' => 'Alaska',
                    'code' => 'AK',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '3',
                    'name' => 'Arizona',
                    'code' => 'AZ',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '4',
                    'name' => 'Arkansas',
                    'code' => 'AR',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '5',
                    'name' => 'California',
                    'code' => 'CA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '6',
                    'name' => 'Colorado',
                    'code' => 'CO',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '7',
                    'name' => 'Connecticut',
                    'code' => 'CT',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '8',
                    'name' => 'Delaware',
                    'code' => 'DE',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '9',
                    'name' => 'Florida',
                    'code' => 'FL',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '10',
                    'name' => 'Georgia',
                    'code' => 'GA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '11',
                    'name' => 'Hawaii',
                    'code' => 'HI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '12',
                    'name' => 'Idaho',
                    'code' => 'ID',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '13',
                    'name' => 'Illinois',
                    'code' => 'IL',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '14',
                    'name' => 'Indiana',
                    'code' => 'IN',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '15',
                    'name' => 'Iowa',
                    'code' => 'IA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '16',
                    'name' => 'Kansas',
                    'code' => 'KS',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '17',
                    'name' => 'Kentucky',
                    'code' => 'KY',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '18',
                    'name' => 'Louisiana',
                    'code' => 'LA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '19',
                    'name' => 'Maine',
                    'code' => 'ME',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '20',
                    'name' => 'Maryland',
                    'code' => 'MD',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '21',
                    'name' => 'Massachusetts',
                    'code' => 'MA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '22',
                    'name' => 'Michigan',
                    'code' => 'MI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '23',
                    'name' => 'Minnesota',
                    'code' => 'MN',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '24',
                    'name' => 'Mississippi',
                    'code' => 'MS',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '25',
                    'name' => 'Missouri',
                    'code' => 'MO',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '26',
                    'name' => 'Montana',
                    'code' => 'MT',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '27',
                    'name' => 'Nebraska',
                    'code' => 'NE',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '28',
                    'name' => 'Nevada',
                    'code' => 'NV',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '29',
                    'name' => 'New Hampshire',
                    'code' => 'NH',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '30',
                    'name' => 'New Jersey',
                    'code' => 'NJ',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '31',
                    'name' => 'New Mexico',
                    'code' => 'NM',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '32',
                    'name' => 'New York',
                    'code' => 'NY',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '33',
                    'name' => 'North Carolina',
                    'code' => 'NC',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '34',
                    'name' => 'North Dakota',
                    'code' => 'ND',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '35',
                    'name' => 'Ohio',
                    'code' => 'OH',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '36',
                    'name' => 'Oklahoma',
                    'code' => 'OK',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '37',
                    'name' => 'Oregon',
                    'code' => 'OR',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '38',
                    'name' => 'Pennsylvania',
                    'code' => 'PA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '39',
                    'name' => 'Rhode Island',
                    'code' => 'RI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '40',
                    'name' => 'South Carolina',
                    'code' => 'SC',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '41',
                    'name' => 'South Dakota',
                    'code' => 'SD',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '42',
                    'name' => 'Tennessee',
                    'code' => 'TN',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '43',
                    'name' => 'Texas',
                    'code' => 'TX',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '44',
                    'name' => 'Utah',
                    'code' => 'UT',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '45',
                    'name' => 'Vermont',
                    'code' => 'VT',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '46',
                    'name' => 'Virginia',
                    'code' => 'VA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '47',
                    'name' => 'Washington',
                    'code' => 'WA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '48',
                    'name' => 'West Virginia',
                    'code' => 'WV',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '49',
                    'name' => 'Wisconsin',
                    'code' => 'WI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '50',
                    'name' => 'Wyoming',
                    'code' => 'WY',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '51',
                    'name' => 'Washington DC',
                    'code' => 'DC',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '52',
                    'name' => 'Puerto Rico',
                    'code' => 'PR',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '53',
                    'name' => 'U.S. Virgin Islands',
                    'code' => 'VI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '54',
                    'name' => 'American Samoa',
                    'code' => 'AS',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '55',
                    'name' => 'Guam',
                    'code' => 'GU',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '56',
                    'name' => 'Northern Mariana Islands',
                    'code' => 'MP',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '60',
                    'name' => 'Alberta',
                    'code' => 'AB',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '61',
                    'name' => 'British Columbia',
                    'code' => 'BC',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '62',
                    'name' => 'Manitoba',
                    'code' => 'MB',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '63',
                    'name' => 'New Brunswick',
                    'code' => 'NB',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '64',
                    'name' => 'Newfoundland and Labrador',
                    'code' => 'NL',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '65',
                    'name' => 'Nova Scotia',
                    'code' => 'NS',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '66',
                    'name' => 'Ontario',
                    'code' => 'ON',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '67',
                    'name' => 'Prince Edward Island',
                    'code' => 'PE',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '68',
                    'name' => 'Quebec',
                    'code' => 'QC',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '69',
                    'name' => 'Saskatchewan',
                    'code' => 'SK',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '70',
                    'name' => 'Northwest Territories',
                    'code' => 'NT',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '71',
                    'name' => 'Nunavut',
                    'code' => 'NU',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '72',
                    'name' => 'Yukon Territory',
                    'code' => 'YT',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '84',
                    'name' => 'Armed Forces Americas',
                    'code' => 'AA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '85',
                    'name' => 'Armed Forces Europe',
                    'code' => 'AE',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'id' => '86',
                    'name' => 'Armed Forces Pacific',
                    'code' => 'AP',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                )
            )
        );
    }
}
