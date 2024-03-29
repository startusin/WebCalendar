<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $query = <<<SQL
            INSERT INTO `countries` (`id`, `numeric_code`, `alpha_code`, `full_alpha_code`, `name`) VALUES
            (1, '4', 'AF', 'AFG', '{"en": "Afghanistan", "fr": "Afghanistan"}'),
            (2, '8', 'AL', 'ALB', '{"en": "Albania", "fr": "Albanie"}'),
            (3, '10', 'AQ', 'ATA', '{"en": "Antarctica", "fr": "Antarctique"}'),
            (4, '12', 'DZ', 'DZA', '{"en": "Algeria", "fr": "Algérie"}'),
            (5, '16', 'AS', 'ASM', '{"en": "American Samoa", "fr": "Samoa Américaines"}'),
            (6, '20', 'AD', 'AND', '{"en": "Andorra", "fr": "Andorre"}'),
            (7, '24', 'AO', 'AGO', '{"en": "Angola", "fr": "Angola"}'),
            (8, '28', 'AG', 'ATG', '{"en": "Antigua and Barbuda", "fr": "Antigua-et-Barbuda"}'),
            (9, '31', 'AZ', 'AZE', '{"en": "Azerbaijan", "fr": "Azerbaïdjan"}'),
            (10, '32', 'AR', 'ARG', '{"en": "Argentina", "fr": "Argentine"}'),
            (11, '36', 'AU', 'AUS', '{"en": "Australia", "fr": "Australie"}'),
            (12, '40', 'AT', 'AUT', '{"en": "Austria", "fr": "Autriche"}'),
            (13, '44', 'BS', 'BHS', '{"en": "Bahamas", "fr": "Bahamas"}'),
            (14, '48', 'BH', 'BHR', '{"en": "Bahrain", "fr": "Bahreïn"}'),
            (15, '50', 'BD', 'BGD', '{"en": "Bangladesh", "fr": "Bangladesh"}'),
            (16, '51', 'AM', 'ARM', '{"en": "Armenia", "fr": "Arménie"}'),
            (17, '52', 'BB', 'BRB', '{"en": "Barbados", "fr": "Barbade"}'),
            (18, '56', 'BE', 'BEL', '{"en": "Belgium", "fr": "Belgique"}'),
            (19, '60', 'BM', 'BMU', '{"en": "Bermuda", "fr": "Bermudes"}'),
            (20, '64', 'BT', 'BTN', '{"en": "Bhutan", "fr": "Bhoutan"}'),
            (21, '68', 'BO', 'BOL', '{"en": "Bolivia", "fr": "Bolivie"}'),
            (22, '70', 'BA', 'BIH', '{"en": "Bosnia and Herzegovina", "fr": "Bosnie-Herzégovine"}'),
            (23, '72', 'BW', 'BWA', '{"en": "Botswana", "fr": "Botswana"}'),
            (24, '74', 'BV', 'BVT', '{"en": "Bouvet Island", "fr": "Île Bouvet"}'),
            (25, '76', 'BR', 'BRA', '{"en": "Brazil", "fr": "Brésil"}'),
            (26, '84', 'BZ', 'BLZ', '{"en": "Belize", "fr": "Belize"}'),
            (27, '86', 'IO', 'IOT', '{"en": "British Indian Ocean Territory", "fr": "Territoire Britannique de l''Océan Indien"}'),
            (28, '90', 'SB', 'SLB', '{"en": "Solomon Islands", "fr": "Îles Salomon"}'),
            (29, '92', 'VG', 'VGB', '{"en": "British Virgin Islands", "fr": "Îles Vierges Britanniques"}'),
            (30, '96', 'BN', 'BRN', '{"en": "Brunei Darussalam", "fr": "Brunéi Darussalam"}'),
            (31, '100', 'BG', 'BGR', '{"en": "Bulgaria", "fr": "Bulgarie"}'),
            (32, '104', 'MM', 'MMR', '{"en": "Myanmar", "fr": "Myanmar"}'),
            (33, '108', 'BI', 'BDI', '{"en": "Burundi", "fr": "Burundi"}'),
            (34, '112', 'BY', 'BLR', '{"en": "Belarus", "fr": "Bélarus"}'),
            (35, '116', 'KH', 'KHM', '{"en": "Cambodia", "fr": "Cambodge"}'),
            (36, '120', 'CM', 'CMR', '{"en": "Cameroon", "fr": "Cameroun"}'),
            (37, '124', 'CA', 'CAN', '{"en": "Canada", "fr": "Canada"}'),
            (38, '132', 'CV', 'CPV', '{"en": "Cape Verde", "fr": "Cap-vert"}'),
            (39, '136', 'KY', 'CYM', '{"en": "Cayman Islands", "fr": "Îles Caïmanes"}'),
            (40, '140', 'CF', 'CAF', '{"en": "Central African", "fr": "République Centrafricaine"}'),
            (41, '144', 'LK', 'LKA', '{"en": "Sri Lanka", "fr": "Sri Lanka"}'),
            (42, '148', 'TD', 'TCD', '{"en": "Chad", "fr": "Tchad"}'),
            (43, '152', 'CL', 'CHL', '{"en": "Chile", "fr": "Chili"}'),
            (44, '156', 'CN', 'CHN', '{"en": "China", "fr": "Chine"}'),
            (45, '158', 'TW', 'TWN', '{"en": "Taiwan", "fr": "Taïwan"}'),
            (46, '162', 'CX', 'CXR', '{"en": "Christmas Island", "fr": "Île Christmas"}'),
            (47, '166', 'CC', 'CCK', '{"en": "Cocos (Keeling) Islands", "fr": "Îles Cocos (Keeling)"}'),
            (48, '170', 'CO', 'COL', '{"en": "Colombia", "fr": "Colombie"}'),
            (49, '174', 'KM', 'COM', '{"en": "Comoros", "fr": "Comores"}'),
            (50, '175', 'YT', 'MYT', '{"en": "Mayotte", "fr": "Mayotte"}'),
            (51, '178', 'CG', 'COG', '{"en": "Congo (Brazzaville)", "fr": "Congo (Brazzaville)"}'),
            (52, '180', 'CD', 'COD', '{"en": "Congo, Democratic Republic of the", "fr": "Congo (Kinshasa)"}'),
            (53, '184', 'CK', 'COK', '{"en": "Cook Islands", "fr": "Îles Cook"}'),
            (54, '188', 'CR', 'CRI', '{"en": "Costa Rica", "fr": "Costa Rica"}'),
            (55, '191', 'HR', 'HRV', '{"en": "Croatia", "fr": "Croatie"}'),
            (56, '192', 'CU', 'CUB', '{"en": "Cuba", "fr": "Cuba"}'),
            (57, '196', 'CY', 'CYP', '{"en": "Cyprus", "fr": "Chypre"}'),
            (58, '203', 'CZ', 'CZE', '{"en": "Czech Republic", "fr": "Tchéquie"}'),
            (59, '204', 'BJ', 'BEN', '{"en": "Benin", "fr": "Bénin"}'),
            (60, '208', 'DK', 'DNK', '{"en": "Denmark", "fr": "Danemark"}'),
            (61, '212', 'DM', 'DMA', '{"en": "Dominica", "fr": "Dominique"}'),
            (62, '214', 'DO', 'DOM', '{"en": "Dominican Republic", "fr": "République Dominicaine"}'),
            (63, '218', 'EC', 'ECU', '{"en": "Ecuador", "fr": "Équateur"}'),
            (64, '222', 'SV', 'SLV', '{"en": "El Salvador", "fr": "Salvador"}'),
            (65, '226', 'GQ', 'GNQ', '{"en": "Equatorial Guinea", "fr": "Guinée Équatoriale"}'),
            (66, '231', 'ET', 'ETH', '{"en": "Ethiopia", "fr": "Éthiopie"}'),
            (67, '232', 'ER', 'ERI', '{"en": "Eritrea", "fr": "Érythrée"}'),
            (68, '233', 'EE', 'EST', '{"en": "Estonia", "fr": "Estonie"}'),
            (69, '234', 'FO', 'FRO', '{"en": "Faroe Islands", "fr": "Îles Féroé"}'),
            (70, '238', 'FK', 'FLK', '{"en": "Falkland Islands (Malvinas)", "fr": "Îles Malouines"}'),
            (71, '239', 'GS', 'SGS', '{"en": "South Georgia and the South Sandwich Islands", "fr": "Géorgie du Sud-et-les Îles Sandwich du Sud"}'),
            (72, '242', 'FJ', 'FJI', '{"en": "Fiji", "fr": "Fidji"}'),
            (73, '246', 'FI', 'FIN', '{"en": "Finland", "fr": "Finlande"}'),
            (74, '248', 'AX', 'ALA', '{"en": "Åland Islands", "fr": "Îles Åland"}'),
            (75, '250', 'FR', 'FRA', '{"en": "France", "fr": "France"}'),
            (76, '254', 'GF', 'GUF', '{"en": "French Guiana", "fr": "Guyane Française"}'),
            (77, '258', 'PF', 'PYF', '{"en": "French Polynesia", "fr": "Polynésie Française"}'),
            (78, '260', 'TF', 'ATF', '{"en": "French Southern Territories", "fr": "Terres Australes Françaises"}'),
            (79, '262', 'DJ', 'DJI', '{"en": "Djibouti", "fr": "Djibouti"}'),
            (80, '266', 'GA', 'GAB', '{"en": "Gabon", "fr": "Gabon"}'),
            (81, '268', 'GE', 'GEO', '{"en": "Georgia", "fr": "Géorgie"}'),
            (82, '270', 'GM', 'GMB', '{"en": "Gambia", "fr": "Gambie"}'),
            (83, '275', 'PS', 'PSE', '{"en": "Palestinian Territory", "fr": "Territoire Palestinien"}'),
            (84, '276', 'DE', 'DEU', '{"en": "Germany", "fr": "Allemagne"}'),
            (85, '288', 'GH', 'GHA', '{"en": "Ghana", "fr": "Ghana"}'),
            (86, '292', 'GI', 'GIB', '{"en": "Gibraltar", "fr": "Gibraltar"}'),
            (87, '296', 'KI', 'KIR', '{"en": "Kiribati", "fr": "Kiribati"}'),
            (88, '300', 'GR', 'GRC', '{"en": "Greece", "fr": "Grèce"}'),
            (89, '304', 'GL', 'GRL', '{"en": "Greenland", "fr": "Groenland"}'),
            (90, '308', 'GD', 'GRD', '{"en": "Grenada", "fr": "Grenade"}'),
            (91, '312', 'GP', 'GLP', '{"en": "Guadeloupe", "fr": "Guadeloupe"}'),
            (92, '316', 'GU', 'GUM', '{"en": "Guam", "fr": "Guam"}'),
            (93, '320', 'GT', 'GTM', '{"en": "Guatemala", "fr": "Guatemala"}'),
            (94, '324', 'GN', 'GIN', '{"en": "Guinea", "fr": "Guinée"}'),
            (95, '328', 'GY', 'GUY', '{"en": "Guyana", "fr": "Guyana"}'),
            (96, '332', 'HT', 'HTI', '{"en": "Haiti", "fr": "Haïti"}'),
            (97, '334', 'HM', 'HMD', '{"en": "Heard Island and McDonald Islands", "fr": "Îles Heard-et-MacDonald"}'),
            (98, '336', 'VA', 'VAT', '{"en": "Holy See (Vatican City State)", "fr": "Saint-Siège (État de la Cité du Vatican)"}'),
            (99, '340', 'HN', 'HND', '{"en": "Honduras", "fr": "Honduras"}'),
            (100, '344', 'HK', 'HKG', '{"en": "Hong Kong, SAR China", "fr": "Hong Kong"}'),
            (101, '348', 'HU', 'HUN', '{"en": "Hungary", "fr": "Hongrie"}'),
            (102, '352', 'IS', 'ISL', '{"en": "Iceland", "fr": "Islande"}'),
            (103, '356', 'IN', 'IND', '{"en": "India", "fr": "Inde"}'),
            (104, '360', 'ID', 'IDN', '{"en": "Indonesia", "fr": "Indonésie"}'),
            (105, '364', 'IR', 'IRN', '{"en": "Iran, Islamic Republic of", "fr": "Iran"}'),
            (106, '368', 'IQ', 'IRQ', '{"en": "Iraq", "fr": "Iraq"}'),
            (107, '372', 'IE', 'IRL', '{"en": "Ireland", "fr": "Irlande"}'),
            (108, '376', 'IL', 'ISR', '{"en": "Israel", "fr": "Israël"}'),
            (109, '380', 'IT', 'ITA', '{"en": "Italy", "fr": "Italie"}'),
            (110, '384', 'CI', 'CIV', '{"en": "Côte d''Ivoire", "fr": "Côte d''Ivoire"}'),
            (111, '388', 'JM', 'JAM', '{"en": "Jamaica", "fr": "Jamaïque"}'),
            (112, '392', 'JP', 'JPN', '{"en": "Japan", "fr": "Japon"}'),
            (113, '398', 'KZ', 'KAZ', '{"en": "Kazakhstan", "fr": "Kazakhstan"}'),
            (114, '400', 'JO', 'JOR', '{"en": "Jordan", "fr": "Jordanie"}'),
            (115, '404', 'KE', 'KEN', '{"en": "Kenya", "fr": "Kenya"}'),
            (116, '408', 'KP', 'PRK', '{"en": "Korea (North)", "fr": "Corée du Nord"}'),
            (117, '410', 'KR', 'KOR', '{"en": "Korea (South)", "fr": "Corée du Sud"}'),
            (118, '414', 'KW', 'KWT', '{"en": "Kuwait", "fr": "Koweït"}'),
            (119, '417', 'KG', 'KGZ', '{"en": "Kyrgyzstan", "fr": "Kirghizistan"}'),
            (120, '418', 'LA', 'LAO', '{"en": "Lao PDR", "fr": "Laos"}'),
            (121, '422', 'LB', 'LBN', '{"en": "Lebanon", "fr": "Liban"}'),
            (122, '426', 'LS', 'LSO', '{"en": "Lesotho", "fr": "Lesotho"}'),
            (123, '428', 'LV', 'LVA', '{"en": "Latvia", "fr": "Lettonie"}'),
            (124, '430', 'LR', 'LBR', '{"en": "Liberia", "fr": "Libéria"}'),
            (125, '434', 'LY', 'LBY', '{"en": "Libya", "fr": "Libye"}'),
            (126, '438', 'LI', 'LIE', '{"en": "Liechtenstein", "fr": "Liechtenstein"}'),
            (127, '440', 'LT', 'LTU', '{"en": "Lithuania", "fr": "Lituanie"}'),
            (128, '442', 'LU', 'LUX', '{"en": "Luxembourg", "fr": "Luxembourg"}'),
            (129, '446', 'MO', 'MAC', '{"en": "Macao, SAR China", "fr": "Macao"}'),
            (130, '450', 'MG', 'MDG', '{"en": "Madagascar", "fr": "Madagascar"}'),
            (131, '454', 'MW', 'MWI', '{"en": "Malawi", "fr": "Malawi"}'),
            (132, '458', 'MY', 'MYS', '{"en": "Malaysia", "fr": "Malaisie"}'),
            (133, '462', 'MV', 'MDV', '{"en": "Maldives", "fr": "Maldives"}'),
            (134, '466', 'ML', 'MLI', '{"en": "Mali", "fr": "Mali"}'),
            (135, '470', 'MT', 'MLT', '{"en": "Malta", "fr": "Malte"}'),
            (136, '474', 'MQ', 'MTQ', '{"en": "Martinique", "fr": "Martinique"}'),
            (137, '478', 'MR', 'MRT', '{"en": "Mauritania", "fr": "Mauritanie"}'),
            (138, '480', 'MU', 'MUS', '{"en": "Mauritius", "fr": "Île Maurice"}'),
            (139, '484', 'MX', 'MEX', '{"en": "Mexico", "fr": "Mexique"}'),
            (140, '492', 'MC', 'MCO', '{"en": "Monaco", "fr": "Monaco"}'),
            (141, '496', 'MN', 'MNG', '{"en": "Mongolia", "fr": "Mongolie"}'),
            (142, '498', 'MD', 'MDA', '{"en": "Moldova", "fr": "Moldavie"}'),
            (143, '499', 'ME', 'MNE', '{"en": "Montenegro", "fr": "Monténégro"}'),
            (144, '500', 'MS', 'MSR', '{"en": "Montserrat", "fr": "Montserrat"}'),
            (145, '504', 'MA', 'MAR', '{"en": "Morocco", "fr": "Maroc"}'),
            (146, '508', 'MZ', 'MOZ', '{"en": "Mozambique", "fr": "Mozambique"}'),
            (147, '512', 'OM', 'OMN', '{"en": "Oman", "fr": "Oman"}'),
            (148, '516', 'NA', 'NAM', '{"en": "Namibia", "fr": "Namibie"}'),
            (149, '520', 'NR', 'NRU', '{"en": "Nauru", "fr": "Nauru"}'),
            (150, '524', 'NP', 'NPL', '{"en": "Nepal", "fr": "Népal"}'),
            (151, '528', 'NL', 'NLD', '{"en": "Netherlands", "fr": "Pays-Bas"}'),
            (152, '531', 'CW', 'CUW', '{"en": "Curaçao", "fr": "Curaçao"}'),
            (153, '533', 'AW', 'ABW', '{"en": "Aruba", "fr": "Aruba"}'),
            (154, '540', 'NC', 'NCL', '{"en": "New Caledonia", "fr": "Nouvelle-Calédonie"}'),
            (155, '548', 'VU', 'VUT', '{"en": "Vanuatu", "fr": "Vanuatu"}'),
            (156, '554', 'NZ', 'NZL', '{"en": "New Zealand", "fr": "Nouvelle-Zélande"}'),
            (157, '558', 'NI', 'NIC', '{"en": "Nicaragua", "fr": "Nicaragua"}'),
            (158, '562', 'NE', 'NER', '{"en": "Niger", "fr": "Niger"}'),
            (159, '566', 'NG', 'NGA', '{"en": "Nigeria", "fr": "Nigéria"}'),
            (160, '570', 'NU', 'NIU', '{"en": "Niue", "fr": "Niué"}'),
            (161, '574', 'NF', 'NFK', '{"en": "Norfolk Island", "fr": "Île Norfolk"}'),
            (162, '578', 'NO', 'NOR', '{"en": "Norway", "fr": "Norvège"}'),
            (163, '580', 'MP', 'MNP', '{"en": "Northern Mariana Islands", "fr": "Îles Mariannes du Nord"}'),
            (164, '581', 'UM', 'UMI', '{"en": "United States Minor Outlying Islands", "fr": "Îles Mineures Éloignées des États-Unis"}'),
            (165, '583', 'FM', 'FSM', '{"en": "Micronesia, Federated States of", "fr": "Micronésie"}'),
            (166, '584', 'MH', 'MHL', '{"en": "Marshall Islands", "fr": "Îles Marshall"}'),
            (167, '585', 'PW', 'PLW', '{"en": "Palau", "fr": "Palaos"}'),
            (168, '586', 'PK', 'PAK', '{"en": "Pakistan", "fr": "Pakistan"}'),
            (169, '591', 'PA', 'PAN', '{"en": "Panama", "fr": "Panama"}'),
            (170, '598', 'PG', 'PNG', '{"en": "Papua New Guinea", "fr": "Papouasie-Nouvelle-Guinée"}'),
            (171, '600', 'PY', 'PRY', '{"en": "Paraguay", "fr": "Paraguay"}'),
            (172, '604', 'PE', 'PER', '{"en": "Peru", "fr": "Pérou"}'),
            (173, '608', 'PH', 'PHL', '{"en": "Philippines", "fr": "Philippines"}'),
            (174, '612', 'PN', 'PCN', '{"en": "Pitcairn", "fr": "Pitcairn"}'),
            (175, '616', 'PL', 'POL', '{"en": "Poland", "fr": "Pologne"}'),
            (176, '620', 'PT', 'PRT', '{"en": "Portugal", "fr": "Portugal"}'),
            (177, '624', 'GW', 'GNB', '{"en": "Guinea-Bissau", "fr": "Guinée-Bissau"}'),
            (178, '626', 'TL', 'TLS', '{"en": "Timor-Leste", "fr": "Timor-Leste"}'),
            (179, '630', 'PR', 'PRI', '{"en": "Puerto Rico", "fr": "Porto Rico"}'),
            (180, '634', 'QA', 'QAT', '{"en": "Qatar", "fr": "Qatar"}'),
            (181, '638', 'RE', 'REU', '{"en": "Réunion", "fr": "Réunion"}'),
            (182, '642', 'RO', 'ROU', '{"en": "Romania", "fr": "Roumanie"}'),
            (183, '643', 'RU', 'RUS', '{"en": "Russian Federation", "fr": "Russie"}'),
            (184, '646', 'RW', 'RWA', '{"en": "Rwanda", "fr": "Rwanda"}'),
            (185, '652', 'BL', 'BLM', '{"en": "Saint-Barthélemy", "fr": "Saint-Barthélemy"}'),
            (186, '654', 'SH', 'SHN', '{"en": "Saint Helena", "fr": "Sainte-Hélène"}'),
            (187, '659', 'KN', 'KNA', '{"en": "Saint Kitts and Nevis", "fr": "Saint-Kitts-et-Nevis"}'),
            (188, '660', 'AI', 'AIA', '{"en": "Anguilla", "fr": "Anguilla"}'),
            (189, '662', 'LC', 'LCA', '{"en": "Saint Lucia", "fr": "Sainte-Lucie"}'),
            (190, '663', 'MF', 'MAF', '{"en": "Saint-Martin (French part)", "fr": "Saint-Martin (partie française)"}'),
            (191, '666', 'PM', 'SPM', '{"en": "Saint Pierre and Miquelon", "fr": "Saint-Pierre-et-Miquelon"}'),
            (192, '670', 'VC', 'VCT', '{"en": "Saint Vincent and Grenadines", "fr": "Saint-Vincent-et-les Grenadines"}'),
            (193, '674', 'SM', 'SMR', '{"en": "San Marino", "fr": "Saint-Marin"}'),
            (194, '678', 'ST', 'STP', '{"en": "Sao Tome and Principe", "fr": "Sao Tomé-et-Principe"}'),
            (195, '682', 'SA', 'SAU', '{"en": "Saudi Arabia", "fr": "Arabie Saoudite"}'),
            (196, '686', 'SN', 'SEN', '{"en": "Senegal", "fr": "Sénégal"}'),
            (197, '688', 'RS', 'SRB', '{"en": "Serbia", "fr": "Serbie"}'),
            (198, '690', 'SC', 'SYC', '{"en": "Seychelles", "fr": "Seychelles"}'),
            (199, '694', 'SL', 'SLE', '{"en": "Sierra Leone", "fr": "Sierra Leone"}'),
            (200, '702', 'SG', 'SGP', '{"en": "Singapore", "fr": "Singapour"}'),
            (201, '703', 'SK', 'SVK', '{"en": "Slovakia", "fr": "Slovaquie"}'),
            (202, '704', 'VN', 'VNM', '{"en": "Vietnam", "fr": "Vietnam"}'),
            (203, '705', 'SI', 'SVN', '{"en": "Slovenia", "fr": "Slovénie"}'),
            (204, '706', 'SO', 'SOM', '{"en": "Somalia", "fr": "Somalie"}'),
            (205, '710', 'ZA', 'ZAF', '{"en": "South Africa", "fr": "Afrique du Sud"}'),
            (206, '716', 'ZW', 'ZWE', '{"en": "Zimbabwe", "fr": "Zimbabwe"}'),
            (207, '724', 'ES', 'ESP', '{"en": "Spain", "fr": "Espagne"}'),
            (208, '732', 'EH', 'ESH', '{"en": "Western Sahara", "fr": "Sahara Occidental"}'),
            (209, '736', 'SD', 'SDN', '{"en": "Sudan", "fr": "Soudan"}'),
            (210, '740', 'SR', 'SUR', '{"en": "Suriname", "fr": "Suriname"}'),
            (211, '744', 'SJ', 'SJM', '{"en": "Svalbard and Jan Mayen Islands", "fr": "Svalbard et Jan Mayen"}'),
            (212, '748', 'SZ', 'SWZ', '{"en": "Swaziland", "fr": "Swaziland"}'),
            (213, '752', 'SE', 'SWE', '{"en": "Sweden", "fr": "Suède"}'),
            (214, '756', 'CH', 'CHE', '{"en": "Switzerland", "fr": "Suisse"}'),
            (215, '760', 'SY', 'SYR', '{"en": "Syrian Arab Republic (Syria)", "fr": "Syrie"}'),
            (216, '762', 'TJ', 'TJK', '{"en": "Tajikistan", "fr": "Tadjikistan"}'),
            (217, '764', 'TH', 'THA', '{"en": "Thailand", "fr": "Thaïlande"}'),
            (218, '768', 'TG', 'TGO', '{"en": "Togo", "fr": "Togo"}'),
            (219, '772', 'TK', 'TKL', '{"en": "Tokelau", "fr": "Tokelau"}'),
            (220, '776', 'TO', 'TON', '{"en": "Tonga", "fr": "Tonga"}'),
            (221, '780', 'TT', 'TTO', '{"en": "Trinidad and Tobago", "fr": "Trinité-et-Tobago"}'),
            (222, '784', 'AE', 'ARE', '{"en": "United Arab Emirates", "fr": "Émirats Arabes Unis"}'),
            (223, '788', 'TN', 'TUN', '{"en": "Tunisia", "fr": "Tunisie"}'),
            (224, '792', 'TR', 'TUR', '{"en": "Turkey", "fr": "Turquie"}'),
            (225, '795', 'TM', 'TKM', '{"en": "Turkmenistan", "fr": "Turkménistan"}'),
            (226, '796', 'TC', 'TCA', '{"en": "Turks and Caicos Islands", "fr": "Îles Turks et Caïques"}'),
            (227, '798', 'TV', 'TUV', '{"en": "Tuvalu", "fr": "Tuvalu"}'),
            (228, '800', 'UG', 'UGA', '{"en": "Uganda", "fr": "Ouganda"}'),
            (229, '804', 'UA', 'UKR', '{"en": "Ukraine", "fr": "Ukraine"}'),
            (230, '807', 'MK', 'MKD', '{"en": "Macedonia, Republic of", "fr": "Macédoine"}'),
            (231, '818', 'EG', 'EGY', '{"en": "Egypt", "fr": "Égypte"}'),
            (232, '826', 'GB', 'GBR', '{"en": "United Kingdom", "fr": "Royaume-Uni"}'),
            (233, '831', 'GG', 'GGY', '{"en": "Guernsey", "fr": "Guernesey"}'),
            (234, '832', 'JE', 'JEY', '{"en": "Jersey", "fr": "Jersey"}'),
            (235, '833', 'IM', 'IMN', '{"en": "Isle of Man", "fr": "Île de Man"}'),
            (236, '834', 'TZ', 'TZA', '{"en": "Tanzania, United Republic of", "fr": "Tanzanie"}'),
            (237, '840', 'US', 'USA', '{"en": "United States of America", "fr": "États-Unis"}'),
            (238, '850', 'VI', 'VIR', '{"en": "US Virgin Islands", "fr": "Îles Vierges des États-Unis"}'),
            (239, '854', 'BF', 'BFA', '{"en": "Burkina Faso", "fr": "Burkina Faso"}'),
            (240, '858', 'UY', 'URY', '{"en": "Uruguay", "fr": "Uruguay"}'),
            (241, '860', 'UZ', 'UZB', '{"en": "Uzbekistan", "fr": "Ouzbékistan"}'),
            (242, '862', 'VE', 'VEN', '{"en": "Venezuela (Bolivarian Republic)", "fr": "Venezuela"}'),
            (243, '876', 'WF', 'WLF', '{"en": "Wallis and Futuna Islands", "fr": "Wallis et Futuna"}'),
            (244, '882', 'WS', 'WSM', '{"en": "Samoa", "fr": "Samoa"}'),
            (245, '887', 'YE', 'YEM', '{"en": "Yemen", "fr": "Yémen"}'),
            (246, '894', 'ZM', 'ZMB', '{"en": "Zambia", "fr": "Zambie"}');
        SQL;

        DB::statement($query);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendar_countries');
    }
};
