<?php
/*
* 2007-2013 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2013 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_'))
	exit;

class StThemeEditor extends Module
{	
    protected static $access_rights = 0775;
    public $imgtype = array('jpg', 'gif', 'jpeg', 'png');
    public $defaults;
    private $_html;
    private $_hooks;
    public $fields_form; 
    public $fields_value;   
    public $validation_errors = array();
    private $systemFonts = array("Helvetica","Arial","Verdana","Georgia","Tahoma","Times New Roman","sans-serif");
    private $googleFonts = array('ABeeZee','Abel','Abril Fatface','Aclonica','Acme','Actor','Adamina','Advent Pro','Aguafina Script','Akronim','Aladin','Aldrich','Alef','Alegreya','Alegreya SC','Alex Brush','Alfa Slab One','Alice','Alike','Alike Angular','Allan','Allerta','Allerta Stencil','Allura','Almendra','Almendra Display','Almendra SC','Amarante','Amaranth','Amatic SC','Amethysta','Anaheim','Andada','Andika','Angkor','Annie Use Your Telescope','Anonymous Pro','Antic','Antic Didone','Antic Slab','Anton','Arapey','Arbutus','Arbutus Slab','Architects Daughter','Archivo Black','Archivo Narrow','Arimo','Arizonia','Armata','Artifika','Arvo','Asap','Asset','Astloch','Asul','Atomic Age','Aubrey','Audiowide','Autour One','Average','Average Sans','Averia Gruesa Libre','Averia Libre','Averia Sans Libre','Averia Serif Libre','Bad Script','Balthazar','Bangers','Basic','Battambang','Baumans','Bayon','Belgrano','Belleza','BenchNine','Bentham','Berkshire Swash','Bevan','Bigelow Rules','Bigshot One','Bilbo','Bilbo Swash Caps','Bitter','Black Ops One','Bokor','Bonbon','Boogaloo','Bowlby One','Bowlby One SC','Brawler','Bree Serif','Bubblegum Sans','Bubbler One','Buda','Buenard','Butcherman','Butterfly Kids','Cabin','Cabin Condensed','Cabin Sketch','Caesar Dressing','Cagliostro','Calligraffitti','Cambo','Candal','Cantarell','Cantata One','Cantora One','Capriola','Cardo','Carme','Carrois Gothic','Carrois Gothic SC','Carter One','Caudex','Cedarville Cursive','Ceviche One','Changa One','Chango','Chau Philomene One','Chela One','Chelsea Market','Chenla','Cherry Cream Soda','Cherry Swash','Chewy','Chicle','Chivo','Cinzel','Cinzel Decorative','Clicker Script','Coda','Coda Caption','Codystar','Combo','Comfortaa','Coming Soon','Concert One','Condiment','Content','Contrail One','Convergence','Cookie','Copse','Corben','Courgette','Cousine','Coustard','Covered By Your Grace','Crafty Girls','Creepster','Crete Round','Crimson Text','Croissant One','Crushed','Cuprum','Cutive','Cutive Mono','Damion','Dancing Script','Dangrek','Dawning of a New Day','Days One','Delius','Delius Swash Caps','Delius Unicase','Della Respira','Denk One','Devonshire','Didact Gothic','Diplomata','Diplomata SC','Domine','Donegal One','Doppio One','Dorsa','Dosis','Dr Sugiyama','Droid Sans','Droid Sans Mono','Droid Serif','Duru Sans','Dynalight','EB Garamond','Eagle Lake','Eater','Economica','Electrolize','Elsie','Elsie Swash Caps','Emblema One','Emilys Candy','Engagement','Englebert','Enriqueta','Erica One','Esteban','Euphoria Script','Ewert','Exo','Expletus Sans','Fanwood Text','Fascinate','Fascinate Inline','Faster One','Fasthand','Federant','Federo','Felipa','Fenix','Finger Paint','Fjalla One','Fjord One','Flamenco','Flavors','Fondamento','Fontdiner Swanky','Forum','Francois One','Freckle Face','Fredericka the Great','Fredoka One','Freehand','Fresca','Frijole','Fruktur','Fugaz One','GFS Didot','GFS Neohellenic','Gabriela','Gafata','Galdeano','Galindo','Gentium Basic','Gentium Book Basic','Geo','Geostar','Geostar Fill','Germania One','Gilda Display','Give You Glory','Glass Antiqua','Glegoo','Gloria Hallelujah','Goblin One','Gochi Hand','Gorditas','Goudy Bookletter 1911','Graduate','Grand Hotel','Gravitas One','Great Vibes','Griffy','Gruppo','Gudea','Habibi','Hammersmith One','Hanalei','Hanalei Fill','Handlee','Hanuman','Happy Monkey','Headland One','Henny Penny','Herr Von Muellerhoff','Holtwood One SC','Homemade Apple','Homenaje','IM Fell DW Pica','IM Fell DW Pica SC','IM Fell Double Pica','IM Fell Double Pica SC','IM Fell English','IM Fell English SC','IM Fell French Canon','IM Fell French Canon SC','IM Fell Great Primer','IM Fell Great Primer SC','Iceberg','Iceland','Imprima','Inconsolata','Inder','Indie Flower','Inika','Irish Grover','Istok Web','Italiana','Italianno','Jacques Francois','Jacques Francois Shadow','Jim Nightshade','Jockey One','Jolly Lodger','Josefin Sans','Josefin Slab','Joti One','Judson','Julee','Julius Sans One','Junge','Jura','Just Another Hand','Just Me Again Down Here','Kameron','Karla','Kaushan Script','Kavoon','Keania One','Kelly Slab','Kenia','Khmer','Kite One','Knewave','Kotta One','Koulen','Kranky','Kreon','Kristi','Krona One','La Belle Aurore','Lancelot','Lato','League Script','Leckerli One','Ledger','Lekton','Lemon','Libre Baskerville','Life Savers','Lilita One','Limelight','Linden Hill','Lobster','Lobster Two','Londrina Outline','Londrina Shadow','Londrina Sketch','Londrina Solid','Lora','Love Ya Like A Sister','Loved by the King','Lovers Quarrel','Luckiest Guy','Lusitana','Lustria','Macondo','Macondo Swash Caps','Magra','Maiden Orange','Mako','Marcellus','Marcellus SC','Marck Script','Margarine','Marko One','Marmelad','Marvel','Mate','Mate SC','Maven Pro','McLaren','Meddon','MedievalSharp','Medula One','Megrim','Meie Script','Merienda','Merienda One','Merriweather','Merriweather Sans','Metal','Metal Mania','Metamorphous','Metrophobic','Michroma','Milonga','Miltonian','Miltonian Tattoo','Miniver','Miss Fajardose','Modern Antiqua','Molengo','Molle','Monda','Monofett','Monoton','Monsieur La Doulaise','Montaga','Montez','Montserrat','Montserrat Alternates','Montserrat Subrayada','Moul','Moulpali','Mountains of Christmas','Mouse Memoirs','Mr Bedfort','Mr Dafoe','Mr De Haviland','Mrs Saint Delafield','Mrs Sheppards','Muli','Mystery Quest','Neucha','Neuton','New Rocker','News Cycle','Niconne','Nixie One','Nobile','Nokora','Norican','Nosifer','Nothing You Could Do','Noticia Text','Nova Cut','Nova Flat','Nova Mono','Nova Oval','Nova Round','Nova Script','Nova Slim','Nova Square','Numans','Nunito','Odor Mean Chey','Offside','Old Standard TT','Oldenburg','Oleo Script','Oleo Script Swash Caps','Open Sans','Open Sans Condensed','Oranienbaum','Orbitron','Oregano','Orienta','Original Surfer','Oswald','Over the Rainbow','Overlock','Overlock SC','Ovo','Oxygen','Oxygen Mono','PT Mono','PT Sans','PT Sans Caption','PT Sans Narrow','PT Serif','PT Serif Caption','Pacifico','Paprika','Parisienne','Passero One','Passion One','Patrick Hand','Patrick Hand SC','Patua One','Paytone One','Peralta','Permanent Marker','Petit Formal Script','Petrona','Philosopher','Piedra','Pinyon Script','Pirata One','Plaster','Play','Playball','Playfair Display','Playfair Display SC','Podkova','Poiret One','Poller One','Poly','Pompiere','Pontano Sans','Port Lligat Sans','Port Lligat Slab','Prata','Preahvihear','Press Start 2P','Princess Sofia','Prociono','Prosto One','Puritan','Purple Purse','Quando','Quantico','Quattrocento','Quattrocento Sans','Questrial','Quicksand','Quintessential','Qwigley','Racing Sans One','Radley','Raleway','Raleway Dots','Rambla','Rammetto One','Ranchers','Rancho','Rationale','Redressed','Reenie Beanie','Revalia','Ribeye','Ribeye Marrow','Righteous','Risque','Roboto','Roboto Condensed','Rochester','Rock Salt','Rokkitt','Romanesco','Ropa Sans','Rosario','Rosarivo','Rouge Script','Ruda','Rufina','Ruge Boogie','Ruluko','Rum Raisin','Ruslan Display','Russo One','Ruthie','Rye','Sacramento','Sail','Salsa','Sanchez','Sancreek','Sansita One','Sarina','Satisfy','Scada','Schoolbell','Seaweed Script','Sevillana','Seymour One','Shadows Into Light','Shadows Into Light Two','Shanti','Share','Share Tech','Share Tech Mono','Shojumaru','Short Stack','Siemreap','Sigmar One','Signika','Signika Negative','Simonetta','Sintony','Sirin Stencil','Six Caps','Skranji','Slackey','Smokum','Smythe','Sniglet','Snippet','Snowburst One','Sofadi One','Sofia','Sonsie One','Sorts Mill Goudy','Source Code Pro','Source Sans Pro','Special Elite','Spicy Rice','Spinnaker','Spirax','Squada One','Stalemate','Stalinist One','Stardos Stencil','Stint Ultra Condensed','Stint Ultra Expanded','Stoke','Strait','Sue Ellen Francisco','Sunshiney','Supermercado One','Suwannaphum','Swanky and Moo Moo','Syncopate','Tangerine','Taprom','Tauri','Telex','Tenor Sans','Text Me One','The Girl Next Door','Tienne','Tinos','Titan One','Titillium Web','Trade Winds','Trocchi','Trochut','Trykker','Tulpen One','Ubuntu','Ubuntu Condensed','Ubuntu Mono','Ultra','Uncial Antiqua','Underdog','Unica One','UnifrakturCook','UnifrakturMaguntia','Unkempt','Unlock','Unna','VT323','Vampiro One','Varela','Varela Round','Vast Shadow','Vibur','Vidaloka','Viga','Voces','Volkhov','Vollkorn','Voltaire','Waiting for the Sunrise','Wallpoet','Walter Turncoat','Warnes','Wellfleet','Wendy One','Wire One','Yanone Kaffeesatz','Yellowtail','Yeseva One','Yesteryear','Zeyada');
    private $predefinedColor;
    public static $categoryRowProductNbr = array(
		array('id' => 2, 'name' => 2),
		array('id' => 4, 'name' => 4),
		array('id' => 5, 'name' => 5),
    );
    public static $categories_per_row_nbr = array(
		array('id' => 3, 'name' => 3),
		array('id' => 4, 'name' => 4),
		array('id' => 6, 'name' => 6),
		array('id' => 7, 'name' => 7),
    );
    public static $position_right_panel = array(
		array('id' => '1_0', 'name' => 'At bottom of screen'),
		array('id' => '1_10', 'name' => 'Bottom 10%'),
		array('id' => '1_20', 'name' => 'Bottom 20%'),
		array('id' => '1_30', 'name' => 'Bottom 30%'),
		array('id' => '1_40', 'name' => 'Bottom 40%'),
		array('id' => '1_50', 'name' => 'Bottom 50%'),
		array('id' => '2_0', 'name' => 'At top of screen'),
		array('id' => '2_10', 'name' => 'Top 10%'),
		array('id' => '2_20', 'name' => 'Top 20%'),
		array('id' => '2_30', 'name' => 'Top 30%'),
		array('id' => '2_40', 'name' => 'Top 40%'),
		array('id' => '2_50', 'name' => 'Top 50%'),
    );
    
    public static $easing = array(
		array('id' => 0, 'name' => 'swing'),
		array('id' => 1, 'name' => 'easeInQuad'),
		array('id' => 2, 'name' => 'easeOutQuad'),
		array('id' => 3, 'name' => 'easeInOutQuad'),
		array('id' => 4, 'name' => 'easeInCubic'),
		array('id' => 5, 'name' => 'easeOutCubic'),
		array('id' => 6, 'name' => 'easeInOutCubic'),
		array('id' => 7, 'name' => 'easeInQuart'),
		array('id' => 8, 'name' => 'easeOutQuart'),
		array('id' => 9, 'name' => 'easeInOutQuart'),
		array('id' => 10, 'name' => 'easeInQuint'),
		array('id' => 11, 'name' => 'easeOutQuint'),
		array('id' => 12, 'name' => 'easeInOutQuint'),
		array('id' => 13, 'name' => 'easeInSine'),
		array('id' => 14, 'name' => 'easeOutSine'),
		array('id' => 15, 'name' => 'easeInOutSine'),
		array('id' => 16, 'name' => 'easeInExpo'),
		array('id' => 17, 'name' => 'easeOutExpo'),
		array('id' => 18, 'name' => 'easeInOutExpo'),
		array('id' => 19, 'name' => 'easeInCirc'),
		array('id' => 20, 'name' => 'easeOutCirc'),
		array('id' => 21, 'name' => 'easeInOutCirc'),
		array('id' => 22, 'name' => 'easeInElastic'),
		array('id' => 23, 'name' => 'easeOutElastic'),
		array('id' => 24, 'name' => 'easeInOutElastic'),
		array('id' => 25, 'name' => 'easeInBack'),
		array('id' => 26, 'name' => 'easeOutBack'),
		array('id' => 27, 'name' => 'easeInOutBack'),
		array('id' => 28, 'name' => 'easeInBounce'),
		array('id' => 29, 'name' => 'easeOutBounce'),
		array('id' => 30, 'name' => 'easeInOutBounce'),
	);
    public static $items = array(
		array('id' => 2, 'name' => '2'),
		array('id' => 3, 'name' => '3'),
		array('id' => 4, 'name' => '4'),
		array('id' => 5, 'name' => '5'),
		array('id' => 6, 'name' => '6'),
    );
    public static $textTransform = array(
		array('id' => 0, 'name' => 'none'),
		array('id' => 1, 'name' => 'uppercase'),
		array('id' => 2, 'name' => 'lowercase'),
		array('id' => 3, 'name' => 'capitalize'),
    );
    
	public function __construct()
	{
		$this->name = 'stthemeeditor';
		$this->tab = 'administration';
		$this->version = '2.5.9';
		$this->author = 'SUNNYTOO.COM';
		$this->need_instance = 0;

	 	parent::__construct();

		$this->displayName = $this->l('Theme editor');
		$this->description = $this->l('Allows to change theme design');
        
        $this->defaults = array(
            'responsive' => 1,
            'responsive_max' => 1,
            'boxstyle' => 1,
            'welcome' => array('1'=>'Welcome'),
            'welcome_logged' => array('1'=>'Welcome'),
            'welcome_link' => '',
            'product_view' => 'grid_view',
            'copyright_text' => array(1=>'&copy; 2013 Powered by Presta Shop&trade;. All Rights Reserved'),
            'search_label' => array(1=>'Search here'),
            'newsletter_label' => array(1=>'Your e-mail'),
		    'footer_img' => 'img/payment-options.png', 
		    'icon_iphone_57' => 'img/touch-icon-iphone-57.png', 
		    'icon_iphone_72' => 'img/touch-icon-iphone-72.png', 
		    'icon_iphone_114' => 'img/touch-icon-iphone-114.png', 
		    'icon_iphone_144' => 'img/touch-icon-iphone-144.png', 
		    'custom_css' => '', 
		    'custom_js' => '', 
		    'tracking_code' => '', 
            'scroll_to_top' => 1,
            'addtocart_animation' => 0,
            'google_rich_snippets' => 1,
            'display_tax_label' => 0,
            'position_right_panel' => '1_40',
            'flyout_buttons' => 0,
            'length_of_product_name' => 0,
            'logo_position' => 0,
            'logo_height' => 0,
            'megamenu_position' => 0,
            //font
    		"font_text" => '',
    		"font_price" => '',
    		"font_price_size" => 0,
    		"font_heading" => 'Fjalla One',
    		"font_heading_weight" => 0,
    		"font_heading_trans" => 1,
    		"font_heading_size" => 0,
    		"footer_heading_size" => 0,
            /*
    		"font_title" => 'Fjalla One',
    		"font_title_weight" => 0,
    		"font_title_trans" => 1,
    		"font_title_size" => '',
            */
    		"font_menu" => 'Fjalla One',
    		"font_menu_weight" => 0,
    		"font_menu_trans" => 1,
    		"font_menu_size" => 0,
    		"font_cart_btn" => 'Fjalla One',
            "font_latin_support" => 0,
            "font_cyrillic_support" => 0,
            "font_vietnamese" => 0,
            "font_greek_support" => 0,
            //style
            'display_comment_rating' => 1,
            'cate_row_pro_nbr' => 3,
            'pack_row_pro_nbr' => 4,
            'display_left_category' => 1,
            'display_left_product' => 0,
            'display_left_homepage' => 0,
            'display_left_other' => 1,
            'display_category_title' => 1,
            'display_category_desc' => 0,
            'display_category_image' => 0,
            'display_subcate' => 1,
            'categories_per_row' => 5,
            'display_pro_attr' => 0,
            'product_secondary' => 1,
            'show_brand_logo' => 1,
            'display_cate_desc_full' => 0,
            //footer
            'footer_border_color' => '',
            'second_footer_color' => '',
            'footer_color' => '',
            'footer_link_color' => '',
            'footer_link_hover_color' => '',
            
            'footer_top_border_color' => '',
            'footer_top_bg' => '',
            'footer_top_con_bg' => '',
    		"f_top_bg_img" => '',
    		"f_top_bg_repeat" => 0, 
    		"f_top_bg_position" => 0, 
    		"f_top_bg_pattern" => 0, 
            'footer_bg_color' => '',
            'footer_con_bg_color' => '',
    		"footer_bg_img" => '',
    		"footer_bg_repeat" => 0, 
    		"footer_bg_position" => 0, 
    		"footer_bg_pattern" => 0, 
            'footer_secondary_bg' => '',
            'footer_secondary_con_bg' => '',
    		"f_secondary_bg_img" => '',
    		"f_secondary_bg_repeat" => 0, 
    		"f_secondary_bg_position" => 0, 
    		"f_secondary_bg_pattern" => 0, 
            'footer_info_bg' => '',
            'footer_info_con_bg' => '',
    		"f_info_bg_img" => '',
    		"f_info_bg_repeat" => 0, 
    		"f_info_bg_position" => 0, 
    		"f_info_bg_pattern" => 0, 
            //header
            'header_text_color' => '',
            'header_link_color' => '',
            'header_link_hover_color' => '',
            'header_link_hover_bg' => '',
            'dropdown_hover_color' => '',
            'dropdown_bg_color' => '',
    		"header_topbar_bg" => '', 
    		//"header_topbar_bc" => '',
    		"header_topbar_sep" => '',
            'header_bg_color' => '',
            'header_con_bg_color' => '',
    		"header_bg_img" => '',
    		"header_bg_repeat" => 0, 
    		"header_bg_position" => 0, 
    		"header_bg_pattern" => 0,  
            //body
    		"body_bg_color" => '',
    		"body_bg_img" => '',
    		"body_bg_repeat" => 0, 
    		"body_bg_position" => 0, 
    		"body_bg_fixed" => 0,
    		"body_bg_pattern" => 0, 
            //crossselling
            'cs_easing' => 0,
            'cs_slideshow' => 0,
            'cs_s_speed' => 7000,
            'cs_a_speed' => 400,
            'cs_pause_on_hover' => 1,
            'cs_loop' => 0,
            'cs_move' => 0,
            'cs_items' => 4,
            //productcategory
            'pc_easing' => 0,
            'pc_slideshow' => 0,
            'pc_s_speed' => 7000,
            'pc_a_speed' => 400,
            'pc_pause_on_hover' => 1,
            'pc_loop' => 0,
            'pc_move' => 0,
            'pc_items' => 4,
            //accessories
            'ac_easing' => 0,
            'ac_slideshow' => 0,
            'ac_s_speed' => 7000,
            'ac_a_speed' => 400,
            'ac_pause_on_hover' => 1,
            'ac_loop' => 0,
            'ac_move' => 0,
            'ac_items' => 4,
            //bestsellers
            'bs_easing' => 0,
            'bs_slideshow' => 0,
            'bs_s_speed' => 7000,
            'bs_a_speed' => 400,
            'bs_pause_on_hover' => 1,
            'bs_loop' => 0,
            'bs_move' => 0,
            'bs_items' => 4,
            //color
            'text_color' => '',
            'link_color' => '',
            'link_hover_color' => '',
            'breadcrumb_color' => '',
            'breadcrumb_hover_color' => '',
            'breadcrumb_bg' => '',
            'price_color' => '',
            'icon_color' => '',
            'icon_hover_color' => '',
            'icon_bg_color' => '',
            'icon_hover_bg_color' => '',
            'icon_disabled_color' => '',
            'right_panel_border' => '',
            'starts_color' => '',
            'circle_number_color' => '',
            'circle_number_bg' => '',
            'block_headings_color' => '',
            'headings_color' => '',
            'f_top_h_color' => '',
            'footer_h_color' => '',
            'f_secondary_h_color' => '',
            //button
            'btn_color' => '',
            'btn_hover_color' => '',
            'btn_bg_color' => '',
            'btn_hover_bg_color' => '',
            'p_btn_color' => '',
            'p_btn_hover_color' => '',
            'p_btn_bg_color' => '',
            'p_btn_hover_bg_color' => '',
            //menu
            'menu_color' => '',
            'menu_bg_color' => '',
            'menu_hover_color' => '',
            'menu_hover_bg' => '',
            'second_menu_color' => '',
            'second_menu_hover_color' => '',
            'third_menu_color' => '',
            'third_menu_hover_color' => '',
            'menu_mob_color' => '',
            'menu_mob_bg' => '',
            'menu_mob_hover_color' => '',
            'menu_mob_hover_bg' => '',
            'menu_mob_items1_color' => '',
            'menu_mob_items2_color' => '',
            'menu_mob_items3_color' => '',
            'menu_mob_items1_bg' => '',
            'menu_mob_items2_bg' => '',
            'menu_mob_items3_bg' => '',
            //sticker
            'new_color' => '',
            'new_style' => 0,
            'new_bg_color' => '',
            'new_bg_img' => '',
            'new_stickers_width' => '',
            'new_stickers_top' => 25,
            'new_stickers_right' => 0,
            'sale_color' => '',
            'sale_style' => 0,
            'sale_bg_color' => '',
            'sale_bg_img' => '',
            'sale_stickers_width' => '',
            'sale_stickers_top' => 25,
            'sale_stickers_left' => 0,
            'discount_percentage' => 0,
            'price_drop_border_color' => '',
            'price_drop_bg_color' => '',
            'price_drop_color' => '',
            'price_drop_bottom' => 50,
            'price_drop_right' => 10,
            'price_drop_width' => 0,
            //
            'cart_icon' => 0,
            'wishlist_icon' => 0,
            'compare_icon' => 0,
            //
            'pro_tab_color' => '',
            'pro_tab_active_color' => '',
            'pro_tab_bg' => '',
            'pro_tab_active_bg' => '',
            'pro_tab_content_bg' => '',
        );
        $this->predefinedColor = array(
            'responsive_max' => array(
                'green' => '1',
                'gray' => '0',
                'red' => '1',
                'blue' => '1',
                'brown' => '1',
            ),
            'boxstyle' => array(
                'green' => '1',
                'gray' => '2',
                'red' => '1',
                'blue' => '2',
                'brown' => '1',
            ),
            'link_hover_color' => array(
                'green' => '',
                'gray' => '#00A161',
                'red' => '#F64C65',
                'blue' => '#47B0BA',
                'brown' => '#9f824a',
            ),
            'price_color' => array(
                'green' => '',
                'gray' => '#666666',
                'red' => '#F64C65',
                'blue' => '#47B0BA',
                'brown' => '#9f824a',
            ),
            'icon_color' => array(
                'green' => '',
                'gray' => '#666666',
                'red' => '#F64C65',
                'blue' => '#47B0BA',
                'brown' => '#666666',
            ),
            'icon_hover_color' => array(
                'green' => '',
                'gray' => '',
                'red' => '',
                'blue' => '',
                'brown' => '#ffffff',
            ),
            'icon_bg_color' => array(
                'green' => '',
                'gray' => '',
                'red' => '',
                'blue' => '',
                'brown' => '#ffffff',
            ),
            'icon_hover_bg_color' =>  array(
                'green' => '',
                'gray' => '#666666',
                'red' => '#F64C65',
                'blue' => '#47B0BA',
                'brown' => '#9f824a',
            ),
            'icon_disabled_color' => array(
                'green' => '',
                'gray' => '',
                'red' => '',
                'blue' => '',
                'brown' => '',
            ),
            'right_panel_border' => array(
                'green' => '',
                'gray' => '',
                'red' => '',
                'blue' => '',
                'brown' => '',
            ),
            'new_bg_color' => array(
                'green' => '',
                'gray' => '',
                'red' => '#66CFF1',
                'blue' => '#1BD4E6',
                'brown' => '#9f824a',
            ),
            'sale_bg_color' =>  array(
                'green' => '',
                'gray' => '#FF8A00',
                'red' => '',
                'blue' => '#F64C65',
                'brown' => '#F44C64',
            ),
            'btn_bg_color' =>  array(
                'green' => '',
                'gray' => '',
                'red' => '#515963',
                'blue' => '',
                'brown' => '#666666',
            ),
            'btn_hover_bg_color' =>  array(
                'green' => '',
                'gray' => '#333333',
                'red' => '#F64C65',
                'blue' => '#47B0BA',
                'brown' => '#9f824a',
            ),
            'p_btn_bg_color' =>  array(
                'green' => '',
                'gray' => '#666666',
                'red' => '#F64C65',
                'blue' => '#47B0BA',
                'brown' => '#9f824a',
            ),
            'p_btn_hover_bg_color' =>  array(
                'green' => '',
                'gray' => '#333333',
                'red' => '#E0394D',
                'blue' => '#3695A0',
                'brown' => '#906C2E',
            ),
            'header_text_color' =>  array(
                'green' => '',
                'gray' => '#cccccc',
                'red' => '#e5e5e5',
                'blue' => '#ffffff',
                'brown' => '#666666',
            ),
            'header_link_color' =>  array(
                'green' => '',
                'gray' => '#cccccc',
                'red' => '#e5e5e5',
                'blue' => '#ffffff',
                'brown' => '#666666',
            ),
            'header_link_hover_color' =>  array(
                'green' => '',
                'gray' => '#00A161',
                'red' => '#F64C65',
                'blue' => '#47B0BA',
                'brown' => '#9f824a',
            ),
            'header_link_hover_bg' =>  array(
                'green' => '',
                'gray' => '#ffffff',
                'red' => '#ffe4e8',
                'blue' => '#DEF2F3',
                'brown' => '#efefef',
            ),
            'header_topbar_bg' =>  array(
                'green' => '',
                'gray' => '#666666',
                'red' => '#515963',
                'blue' => '#47B0BA',
                'brown' => '#f9f9f9',
            ),
            'header_topbar_sep' =>  array(
                'green' => '',
                'gray' => '#666666',
                'red' => '#6D757F',
                'blue' => '#53BDC7',
                'brown' => '#f2f2f2',
            ),
            'dropdown_hover_color' =>  array(
                'green' => '',
                'gray' => '#00A161',
                'red' => '#F64C65',
                'blue' => '#47B0BA',
                'brown' => '#9f824a',
            ),
            'dropdown_bg_color' =>  array(
                'green' => '',
                'gray' => '#ffffff',
                'red' => '#ffe4e8',
                'blue' => '#DEF2F3',
                'brown' => '#efefef',
            ),
            'menu_hover_color' => array(
                'green' => '',
                'gray' => '',
                'red' => '',
                'blue' => '',
                'brown' => '#9f824a',
            ),
            'menu_hover_bg' =>  array(
                'green' => '',
                'gray' => '#333333',
                'red' => '#F64C65',
                'blue' => '#47B0BA',
                'brown' => '#ffffff',
            ),
            'second_menu_hover_color' => array(
                'green' => '',
                'gray' => '',
                'red' => '#F64C65',
                'blue' => '#47B0BA',
                'brown' => '#9f824a',
            ),
            'third_menu_hover_color' => array(
                'green' => '',
                'gray' => '',
                'red' => '#F64C65',
                'blue' => '#47B0BA',
                'brown' => '#9f824a',
            ),
            'menu_mob_hover_color' => array(
                'green' => '',
                'gray' => '',
                'red' => '#F64C65',
                'blue' => '#47B0BA',
                'brown' => '#9f824a',
            ),
            'body_bg_color' =>  array(
                'green' => '',
                'gray' => '#f9f9f9',
                'red' => '',
                'blue' => '#E8F8FA',
                'brown' => '',
            ),
            'footer_top_border_color'=>  array(
                'green' => '',
                'gray' => '',
                'red' => '#e5e5e5',
                'blue' => '',
                'brown' => '#e5e5e5',
            ),
            'footer_top_bg'=>  array(
                'green' => '',
                'gray' => '',
                'red' => '#ffffff',
                'blue' => '',
                'brown' => '#ffffff',
            ),
            'footer_bg_color'=>  array(
                'green' => '',
                'gray' => '',
                'red' => '#fafafa',
                'blue' => '',
                'brown' => '#fafafa',
            ),
            'footer_border_color' =>  array(
                'green' => '',
                'gray' => '#fafafa',
                'red' => '#fafafa',
                'blue' => '#fafafa',
                'brown' => '#fafafa',
            ),
            'footer_info_bg' =>  array(
                'green' => '',
                'gray' => '',
                'red' => '#515963',
                'blue' => '',
                'brown' => '#000000',
            ),
            'circle_number_bg' => array(
                'green' => '',
                'gray' => '',
                'red' => '',
                'blue' => '',
                'brown' => '#9f824a',
            ),
            'font_text' => array(
                'green' => '',
                'gray' => '',
                'red' => '',
                'blue' => '',
                'brown' => 'Times New Roman',
            ),
            'font_heading' => array(
                'green' => 'Fjalla One',
                'gray' => 'Fjalla One',
                'red' => 'Fjalla One',
                'blue' => 'Fjalla One',
                'brown' => 'Tienne',
            ),
            'font_heading_size' => array(
                'green' => 0,
                'gray' => 0,
                'red' => 0,
                'blue' => 0,
                'brown' => 14,
            ),
            'font_cart_btn' => array(
                'green' => 'Fjalla One',
                'gray' => 'Fjalla One',
                'red' => 'Fjalla One',
                'blue' => 'Fjalla One',
                'brown' => 'Tienne',
            ),
            'font_menu' => array(
                'green' => 'Fjalla One',
                'gray' => 'Fjalla One',
                'red' => 'Fjalla One',
                'blue' => 'Fjalla One',
                'brown' => 'Tienne',
            ),
            'font_menu_size' => array(
                'green' => 0,
                'gray' => 0,
                'red' => 0,
                'blue' => 0,
                'brown' => 14,
            ),
            'custom_css' =>  array(
                'green' => '',
                'gray' => '#body_wrapper{padding-top:20px;padding-bottom:25px;}',
                'red' => '',
                'blue' => '',
                'brown' => '',
            ),
        );
        $this->_hooks = array(
            array('displayTopBar','displayTopBar','Top of the page',1),
            array('displayCategoryFooter','displayCategoryFooter','Display some specific informations on the category page',1),
            array('displayCategoryHeader','displayCategoryHeader','Display some specific informations on the category page',1),
            array('displayTopSecondary','displayTopSecondary','Bottom of the header',1),
            array('displayAnywhere','displayAnywhere','It is easy to call a hook from tpl',1),
            array('displayProductSecondaryColumn','displayProductSecondaryColumn','Product secondary column',1),
            array('displayFooterTop','displayFooterTop','Footer top',1),
            array('displayFooterSecondary','displayFooterSecondary','Footer secondary',1),
            array('displayHomeSecondaryLeft','displayHomeSecondaryLeft','Home secondary left',1),
            array('displayHomeSecondaryRight','displayHomeSecondaryRight','Home secondary right',1),
            array('displayHomeTop','displayHomeTop','Home page top',1),
            array('displayHomeBottom','displayHomeBottom','Hom epage bottom',1),
            array('displayTopLeft','displayTopLeft','Top left-hand side of the page',1),
        );
        if(version_compare(_PS_VERSION_, '1.5.5', '<'))
        {
            $this->_hooks[]= array('actionModuleRegisterHookAfter','actionModuleRegisterHookAfter','',1);
            $this->_hooks[]= array('actionModuleUnRegisterHookAfter','actionModuleUnRegisterHookAfter','',1);
        }
	}
	
	public function install()
	{
	   if ( $this->_addHook() &&
            parent::install() && 
            $this->registerHook('header') && 
            $this->registerHook('displayAnywhere') &&
            $this->registerHook('actionShopDataDuplication') &&
            $this->registerHook('displayAdminHomeQuickLinks') &&
            $this->registerHook('displayRightColumnProduct') &&
            $this->_useDefault()
        )
            return true;
		return false;
	}
	
    private function _addHook()
	{
        $res = true;
        foreach($this->_hooks as $v)
        {
            if(!$res)
                break;
            if (!Validate::isHookName($v[0]))
                continue;
                
            $id_hook = Hook::getIdByName($v[0]);
    		if (!$id_hook)
    		{
    			$new_hook = new Hook();
    			$new_hook->name = pSQL($v[0]);
    			$new_hook->title = pSQL($v[1]);
    			$new_hook->description = pSQL($v[2]);
    			$new_hook->position = pSQL($v[3]);
    			$new_hook->live_edit  = 0;
    			$new_hook->add();
    			$id_hook = $new_hook->id;
    			if (!$id_hook)
    				$res = false;
    		}
            else
            {
                Db::getInstance()->execute('UPDATE `'._DB_PREFIX_.'hook` set `title`="'.$v[1].'", `description`="'.$v[2].'", `position`="'.$v[3].'" where `id_hook`='.$id_hook);
            }
        }
		return $res;
	}

	private function _removeHook()
	{
	    $sql = 'DELETE FROM `'._DB_PREFIX_.'hook` WHERE ';
        foreach($this->_hooks as $v)
            $sql .= ' `name` = "'.$v[0].'" OR';
		return Db::getInstance()->execute(rtrim($sql,'OR').';');
	}
    
	public function uninstall()
	{
	    if(!parent::uninstall() ||
            !$this->_deleteConfiguration()
        )
			return false;
		return true;
	}
    
    private function _deleteConfiguration()
    {
        $res = true;
        foreach($this->defaults as $k=>$v)
            $res &= Configuration::deleteByName('STSN_'.strtoupper($k));
        return $res;
    }
	
    private function _useDefault($html = false, $id_shop_group = null, $id_shop = null)
    {
        $res = true;
        foreach($this->defaults as $k=>$v)
		    $res &= Configuration::updateValue('STSN_'.strtoupper($k), $v, $html, $id_shop_group, $id_shop);
        return $res;
    }
    private function _usePredefinedColor($color)
    {
        $res = true;
        foreach($this->predefinedColor as $k=>$v)
        {
            if($k=='custom_css')
            {
                $custom_css = is_array($v) ? $v[$color] : $v;
                $custom_css_exist =  Configuration::get('STSN_CUSTOM_CSS');
                if($custom_css_exist)
                    foreach($v as $n)
                        $custom_css_exist = str_replace($n,'',$custom_css_exist);
                $res &= Configuration::updateValue('STSN_'.strtoupper($k), ($custom_css.$custom_css_exist));
            }
            else
                $res &= Configuration::updateValue('STSN_'.strtoupper($k), (is_array($v) ? $v[$color] : $v));
        }
        return $res;
    }
    public function uploadCheckAndGetName($name)
    {
		$type = strtolower(substr(strrchr($name, '.'), 1));
        if(!in_array($type, $this->imgtype))
            return false;
        $filename = Tools::encrypt($name.sha1(microtime()));
		while (file_exists(_PS_UPLOAD_DIR_.$filename.'.'.$type)) {
            $filename .= rand(10, 99);
        } 
        return $filename.'.'.$type;
    }
    private function _checkImageDir($dir)
    {
        $result = '';
        if (!file_exists($dir))
        {
            $success = @mkdir($dir, self::$access_rights, true)
						|| @chmod($dir, self::$access_rights);
            if(!$success)
                $result = $this->displayError('"'.$dir.'" '.$this->l('An error occurred during new folder creation'));
        }

        if (!is_writable($dir))
            $result = $this->displayError('"'.$dir.'" '.$this->l('directory isn\'t writable.'));
        
        return $result;
    }
    	
	public function getContent()
	{
	    $this->initFieldsForm();
		$this->context->controller->addCSS(($this->_path).'views/css/admin.css');
		$this->context->controller->addJS(($this->_path).'views/js/admin.js');
        $this->_html .= '<script type="text/javascript">var stthemeeditor_base_uri = "'.__PS_BASE_URI__.'";</script>';
		$languages = Language::getLanguages(false);
        if (Tools::isSubmit('resetstthemeeditor'))
        {
            $this->_useDefault();
            $this->_writeCss();
            Tools::redirectAdmin(AdminController::$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules'));
        }
        if (Tools::isSubmit('predefinedcolorstthemeeditor') && Tools::getValue('predefinedcolorstthemeeditor'))
        {
            $this->_usePredefinedColor(Tools::getValue('predefinedcolorstthemeeditor'));
            $this->_writeCss();
            Tools::redirectAdmin(AdminController::$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules'));
        }
        if(isset($_POST['savestthemeeditor']))
		{
            $res = true;
            foreach($this->fields_form as $form)
                foreach($form['form']['input'] as $field)
                    if(isset($field['validation']))
                    {
                        $ishtml = ($field['validation']=='isAnything') ? true : false;
                        $errors = array();       
                        $value = Tools::getValue($field['name']);
                        if (isset($field['required']) && $field['required'] && $value==false && (string)$value != '0')
        						$errors[] = sprintf(Tools::displayError('Field "%s" is required.'), $field['label']);
                        elseif($value)
                        {
        					if (!Validate::$field['validation']($value))
        						$errors[] = sprintf(Tools::displayError('Field "%s" is invalid.'), $field['label']);
                        }
        				// Set default value
        				if ($value === false && isset($field['default_value']))
        					$value = $field['default_value'];
                            
                        if(count($errors))
                        {
                            $this->validation_errors = array_merge($this->validation_errors, $errors);
                        }
                        elseif($value==false)
                        {
                            switch($field['validation'])
                            {
                                case 'isUnsignedId':
                                case 'isUnsignedInt':
                                case 'isInt':
                                case 'isBool':
                                    $value = 0;
                                break;
                                default:
                                    $value = '';
                                break;
                            }
                            Configuration::updateValue('STSN_'.strtoupper($field['name']), $value);
                        }
                        else
                            Configuration::updateValue('STSN_'.strtoupper($field['name']), $value, $ishtml);
                    }
                
            $this->updateWelcome();
            $this->updateCopyright();
            $this->updateSearchLabel();
            $this->updateNewsletterLabel();
                
            $bg_array = array('body','header','f_top','footer','f_secondary','f_info','new','sale');
            foreach($bg_array as $v)
            {
        			if (isset($_FILES[$v.'_bg_image_field']) && isset($_FILES[$v.'_bg_image_field']['tmp_name']) && !empty($_FILES[$v.'_bg_image_field']['tmp_name'])) 
                    {
        				if ($error = ImageManager::validateUpload($_FILES[$v.'_bg_image_field'], Tools::convertBytes(ini_get('upload_max_filesize'))))
    					   $this->validation_errors[] = Tools::displayError($error);
                        else 
                        {
                            $footer_image = $this->uploadCheckAndGetName($_FILES[$v.'_bg_image_field']['name']);
                            if(!$footer_image)
                                $this->validation_errors[] = Tools::displayError('Image format not recognized');
        					if (!move_uploaded_file($_FILES[$v.'_bg_image_field']['tmp_name'], $this->local_path.'img/'.$footer_image))
        						$this->validation_errors[] = Tools::displayError('Error move uploaded file');
                            else
                            {
        					   Configuration::updateValue('STSN_'.strtoupper($v).'_BG_IMG', 'img/'.$footer_image);
                            }
        				}
        			}
            }   
            
			if (isset($_FILES['footer_image_field']) && isset($_FILES['footer_image_field']['tmp_name']) && !empty($_FILES['footer_image_field']['tmp_name'])) 
            {
				if ($error = ImageManager::validateUpload($_FILES['footer_image_field'], Tools::convertBytes(ini_get('upload_max_filesize'))))
					$this->validation_errors[] = Tools::displayError($error);
                else 
                {
                    $footer_image = $this->uploadCheckAndGetName($_FILES['footer_image_field']['name']);
                    if(!$footer_image)
                        $this->validation_errors[] = Tools::displayError('Image format not recognized');
					else if (!move_uploaded_file($_FILES['footer_image_field']['tmp_name'], _PS_UPLOAD_DIR_.$footer_image))
						$this->validation_errors[] = Tools::displayError('Error move uploaded file');
                    else
                    {
					   Configuration::updateValue('STSN_FOOTER_IMG', $footer_image);
                    }
				}
			}
            $iphone_icon_array = array('57','72','114','144');
            foreach($iphone_icon_array as $v)
            {
        			if (isset($_FILES['icon_iphone_'.$v.'_field']) && isset($_FILES['icon_iphone_'.$v.'_field']['tmp_name']) && !empty($_FILES['icon_iphone_'.$v.'_field']['tmp_name'])) 
                    {
                        $this->_checkImageDir(_PS_MODULE_DIR_.$this->name.'/img/'.$this->context->shop->id.'/');
        				if ($error = ImageManager::validateUpload($_FILES['icon_iphone_'.$v.'_field'], Tools::convertBytes(ini_get('upload_max_filesize'))))
    					   $this->validation_errors[] = Tools::displayError($error);
                        else 
                        {
        					if (!move_uploaded_file($_FILES['icon_iphone_'.$v.'_field']['tmp_name'], $this->local_path.'img/'.$this->context->shop->id.'/touch-icon-iphone-'.$v.'.png'))
        						$this->validation_errors[] = Tools::displayError('Error move uploaded file');
                            else
                            {
        					   Configuration::updateValue('STSN_ICON_IPHONE_'.strtoupper($v), 'img/'.$this->context->shop->id.'/touch-icon-iphone-'.$v.'.png');
                            }
        				}
        			}
            }   
            
            if(count($this->validation_errors))
                $this->_html .= $this->displayError(implode('<br/>',$this->validation_errors));
            else 
                $this->_html .= $this->displayConfirmation($this->l('Settings updated'));
        }
		$helper = $this->initForm();
        
        foreach($this->defaults as $k=>$v)
            $helper->fields_value[$k] = Configuration::get('STSN_'.strtoupper($k));
            
		foreach ($languages as $language)
        {
            $helper->fields_value['welcome'][$language['id_lang']] = Configuration::get('STSN_WELCOME', $language['id_lang']);
            $helper->fields_value['welcome_logged'][$language['id_lang']] = Configuration::get('STSN_WELCOME_LOGGED', $language['id_lang']);
            $helper->fields_value['welcome_link'][$language['id_lang']] = Configuration::get('STSN_WELCOME_LINK', $language['id_lang']);
            $helper->fields_value['copyright_text'][$language['id_lang']] = Configuration::get('STSN_COPYRIGHT_TEXT', $language['id_lang']);
            $helper->fields_value['search_label'][$language['id_lang']] = Configuration::get('STSN_SEARCH_LABEL', $language['id_lang']);
            $helper->fields_value['newsletter_label'][$language['id_lang']] = Configuration::get('STSN_NEWSLETTER_LABEL', $language['id_lang']);
        }
        $tabs_html = '</h2>
        <ul class="st_tabs clearfix">
            <li><a href="javascript:;" title="'.$this->l('General').'" data-fieldset="0" class="selected">'.$this->l('General').'</a></li>
            <li><a href="javascript:;" title="'.$this->l('Categories').'" data-fieldset="1">'.$this->l('Category page').'</a></li>
            <li><a href="javascript:;" title="'.$this->l('Product page').'" data-fieldset="17">'.$this->l('Product page').'</a></li>
            <li><a href="javascript:;" title="'.$this->l('Color').'" data-fieldset="2">'.$this->l('Color').'</a></li>
            <li><a href="javascript:;" title="'.$this->l('Font').'" data-fieldset="3">'.$this->l('Font').'</a></li>
            <li><a href="javascript:;" title="'.$this->l('Sticker').'" data-fieldset="16">'.$this->l('Stickers').'</a></li>
            <li><a href="javascript:;" title="'.$this->l('Header').'" data-fieldset="4">'.$this->l('Header').'</a></li>
            <li><a href="javascript:;" title="'.$this->l('Menu').'" data-fieldset="5">'.$this->l('Menu').'</a></li>
            <li><a href="javascript:;" title="'.$this->l('Body').'" data-fieldset="6">'.$this->l('Body').'</a></li>
            <li><a href="javascript:;" title="'.$this->l('Footer-Top').'" data-fieldset="7">'.$this->l('Footer-Top').'</a></li>
            <li><a href="javascript:;" title="'.$this->l('Footer').'" data-fieldset="8">'.$this->l('Footer').'</a></li>
            <li><a href="javascript:;" title="'.$this->l('Footer-Secondary').'" data-fieldset="9">'.$this->l('Footer-Secondary').'</a></li>
            <li><a href="javascript:;" title="'.$this->l('Footer-Copyright').'" data-fieldset="10">'.$this->l('Footer-Copyright').'</a></li>
            <li><a href="javascript:;" title="'.$this->l('Slider').'" data-fieldset="11,12,13,14">'.$this->l('Sliders').'</a></li>
            <li><a href="javascript:;" title="'.$this->l('Custom code').'" data-fieldset="15">'.$this->l('Custom codes').'</a></li>
        </ul><h2 style="display:none;">
        ';
        $this->fields_form['title'] = $tabs_html;
		return $this->_html.$helper->generateForm($this->fields_form);
	}
    
    public function updateWelcome() {
		$languages = Language::getLanguages(false);
		$welcome = $welcome_logged  = $welcome_link = array();
        $defaultLanguage = new Language((int)(Configuration::get('PS_LANG_DEFAULT')));
		foreach ($languages as $language)
		{
            $welcome[$language['id_lang']] = Tools::getValue('welcome_'.$language['id_lang']) ? Tools::getValue('welcome_'.$language['id_lang']) : Tools::getValue('welcome_'.$defaultLanguage->id);
			$welcome_logged[$language['id_lang']] = Tools::getValue('welcome_logged_'.$language['id_lang']) ? Tools::getValue('welcome_logged_'.$language['id_lang']) : Tools::getValue('welcome_logged_'.$defaultLanguage->id);
			$welcome_link[$language['id_lang']] = Tools::getValue('welcome_link_'.$language['id_lang']) ? Tools::getValue('welcome_link_'.$language['id_lang']) : Tools::getValue('welcome_link_'.$defaultLanguage->id);
		}
        Configuration::updateValue('STSN_WELCOME_LINK', $welcome_link);
        Configuration::updateValue('STSN_WELCOME', $welcome);
        Configuration::updateValue('STSN_WELCOME_LOGGED', $welcome_logged);
	}
    public function updateCopyright() {
		$languages = Language::getLanguages();
		$result = array();
        $defaultLanguage = new Language((int)(Configuration::get('PS_LANG_DEFAULT')));
		foreach ($languages as $language)
			$result[$language['id_lang']] = Tools::getValue('copyright_text_' . $language['id_lang']) ? Tools::getValue('copyright_text_'.$language['id_lang']) : Tools::getValue('copyright_text_'.$defaultLanguage->id);

        if(!$result[$defaultLanguage->id])
            $this->validation_errors[] = Tools::displayError('The field "Copyright text" is required at least in '.$defaultLanguage->name);
		else
            Configuration::updateValue('STSN_COPYRIGHT_TEXT', $result, true);
	}
    public function updateSearchLabel() {
		$languages = Language::getLanguages();
		$result = array();
        $defaultLanguage = new Language((int)(Configuration::get('PS_LANG_DEFAULT')));
		foreach ($languages as $language)
			$result[$language['id_lang']] = Tools::getValue('search_label_' . $language['id_lang']) ? Tools::getValue('search_label_' . $language['id_lang']) : Tools::getValue('search_label_'.$defaultLanguage->id);

        if(!$result[$defaultLanguage->id])
            $this->validation_errors[] = Tools::displayError('The field "Search label" is required at least in '.$defaultLanguage->name);
		else
            Configuration::updateValue('STSN_SEARCH_LABEL', $result);
	}        
    public function updateNewsletterLabel() {
		$languages = Language::getLanguages();
		$result = array();
		$defaultLanguage = new Language((int)(Configuration::get('PS_LANG_DEFAULT')));
		foreach ($languages as $language)
			$result[$language['id_lang']] = Tools::getValue('newsletter_label_' . $language['id_lang']) ? Tools::getValue('newsletter_label_' . $language['id_lang']) : Tools::getValue('newsletter_label_'.$defaultLanguage->id);

        if(!$result[$defaultLanguage->id])
            $this->validation_errors[] = Tools::displayError('The field "Newsletter label" is required at least in '.$defaultLanguage->name);
		else
            Configuration::updateValue('STSN_NEWSLETTER_LABEL', $result);
	}
    public function initFieldsForm()
    {
		$this->fields_form[0]['form'] = array(
			'input' => array(
                array(
					'type' => 'radio',
					'label' => $this->l('Enable responsive layout:'),
					'name' => 'responsive',
					'class' => 't',
					'is_bool' => true,
					'values' => array(
						array(
							'id' => 'responsive_on',
							'value' => 1,
							'label' => $this->l('Yes')),
						array(
							'id' => 'responsive_off',
							'value' => 0,
							'label' => $this->l('No')),
					),
                    'desc' => $this->l('Enable responsive design for mobile devices.'),
                    'validation' => 'isBool',
				), 
                array(
					'type' => 'radio',
					'label' => $this->l('Maximum Page Width:'),
					'name' => 'responsive_max',
					'class' => 't',
					'values' => array(
						array(
							'id' => 'responsive_max_0',
							'value' => 0,
							'label' => $this->l('980')),
						array(
							'id' => 'responsive_max_1',
							'value' => 1,
							'label' => $this->l('1200')),
					),
                    'desc' => $this->l('Maximum width of the page'),
                    'validation' => 'isBool',
				), 
                array(
					'type' => 'radio',
					'label' => $this->l('Box style:'),
					'name' => 'boxstyle',
					'class' => 't',
					'values' => array(
						array(
							'id' => 'boxstyle_on',
							'value' => 1,
							'label' => $this->l('Stretched style')),
						array(
							'id' => 'boxstyle_off',
							'value' => 2,
							'label' => $this->l('Boxed style')),
					),
                    'validation' => 'isUnsignedInt',
				), 
                array(
					'type' => 'radio',
					'label' => $this->l('Show comment rating:'),
					'name' => 'display_comment_rating',
					'class' => 't',
					'values' => array(
						array(
							'id' => 'display_comment_rating_off',
							'value' => 0,
							'label' => $this->l('NO')),
						array(
							'id' => 'display_comment_rating_on',
							'value' => 1,
							'label' => $this->l('Yes')),
						array(
							'id' => 'display_comment_rating_always',
							'value' => 2,
							'label' => $this->l('Always display')),
					),
                    'desc' => $this->l('Always display: show star even if no rating'),
                    'validation' => 'isUnsignedInt',
				), 
                array(
					'type' => 'radio',
					'label' => $this->l('Length of product name:'),
					'name' => 'length_of_product_name',
					'class' => 't',
					'values' => array(
						array(
							'id' => 'length_of_product_name_normal',
							'value' => 0,
							'label' => $this->l('Normal(one line)')),
						array(
							'id' => 'length_of_product_name_long',
							'value' => 1,
							'label' => $this->l('Long(two lines)')),
						array(
							'id' => 'length_of_product_name_full',
							'value' => 2,
							'label' => $this->l('Full name')),
					),
                    'validation' => 'isUnsignedInt',
				), 
                array(
					'type' => 'radio',
					'label' => $this->l('Logo position:'),
					'name' => 'logo_position',
					'class' => 't',
					'values' => array(
						array(
							'id' => 'logo_position_left',
							'value' => 0,
							'label' => $this->l('Left')),
						array(
							'id' => 'logo_position_center',
							'value' => 1,
							'label' => $this->l('Center')),
					),
                    'validation' => 'isUnsignedInt',
				), 
                'logo_height' => array(
					'type' => 'text',
					'label' => $this->l('Header height(px):'),
					'name' => 'logo_height',
                    'validation' => 'isUnsignedInt',
                    'desc' => array(
                        $this->l('This option makes it possible to change the height of header.'),
                        $this->l('If the height of your logo is bigger than 86px then you will need to fill out this filed.'),
                        $this->l('Please make sure the value is lagger than the height of your logo. Currently the logo height is ').Configuration::get('SHOP_LOGO_HEIGHT'),
                        $this->l('Only for logo center.')
                    ),
				),
                array(
					'type' => 'radio',
					'label' => $this->l('Megamenu position:'),
					'name' => 'megamenu_position',
					'class' => 't',
					'values' => array(
						array(
							'id' => 'megamenu_position_left',
							'value' => 0,
							'label' => $this->l('Left')),
						array(
							'id' => 'megamenu_position_center',
							'value' => 1,
							'label' => $this->l('Center')),
						array(
							'id' => 'megamenu_position_right',
							'value' => 2,
							'label' => $this->l('Right')),
					),
                    'validation' => 'isUnsignedInt',
				), 
                array(
					'type' => 'radio',
					'label' => $this->l('Homepage layout:'),
					'name' => 'display_left_homepage',
					'class' => 't',
					'values' => array(
						array(
							'id' => 'display_left_homepage_off',
							'value' => 0,
							'label' => $this->l('One column')),
						array(
							'id' => 'display_left_homepage_left',
							'value' => 1,
							'label' => $this->l('2 columns, leftcolumn')),
						array(
							'id' => 'display_left_homepage_right',
							'value' => 2,
							'label' => $this->l('2 columns, rightcolumn')),
                        /*
						array(
							'id' => 'display_left_homepage_left_right',
							'value' => 3,
							'label' => $this->l('3 columns')),
                        */
					),
                    'validation' => 'isUnsignedInt',
				),
                array(
					'type' => 'radio',
					'label' => $this->l('Categories layout:'),
					'name' => 'display_left_category',
					'class' => 't',
                    //'default_value' => 1,
					'values' => array(
						array(
							'id' => 'display_left_category_off',
							'value' => 0,
							'label' => $this->l('One column')),
						array(
							'id' => 'display_left_category_left',
							'value' => 1,
							'label' => $this->l('2 columns, leftcolumn')),
						array(
							'id' => 'display_left_category_right',
							'value' => 2,
							'label' => $this->l('2 columns, rightcolumn')),
                        /*
						array(
							'id' => 'display_left_category_left_right',
							'value' => 3,
							'label' => $this->l('3 columns')),
                        */
					),
                    'desc' => $this->l('Category page, Speical products pages, New products page etc.'),
                    'validation' => 'isUnsignedInt',
				), 
                array(
					'type' => 'radio',
					'label' => $this->l('Product page layout:'),
					'name' => 'display_left_product',
					'class' => 't',
                    //'default_value' => 0,
					'values' => array(
						array(
							'id' => 'display_left_product_off',
							'value' => 0,
							'label' => $this->l('One column')),
						array(
							'id' => 'display_left_product_left',
							'value' => 1,
							'label' => $this->l('2 columns, leftcolumn')),
						array(
							'id' => 'display_left_product_right',
							'value' => 2,
							'label' => $this->l('2 columns, rightcolumn')),
                        /*
						array(
							'id' => 'display_left_product_left_right',
							'value' => 3,
							'label' => $this->l('3 columns')),
                        */
					),
                    'validation' => 'isUnsignedInt',
				), 
                array(
					'type' => 'radio',
					'label' => $this->l('Other pages layout:'),
					'name' => 'display_left_other',
					'class' => 't',
                    //'default_value' => 1,
					'values' => array(
						array(
							'id' => 'display_left_other_off',
							'value' => 0,
							'label' => $this->l('One column')),
						array(
							'id' => 'display_left_other_left',
							'value' => 1,
							'label' => $this->l('2 columns, leftcolumn')),
						array(
							'id' => 'display_left_other_right',
							'value' => 2,
							'label' => $this->l('2 columns, rightcolumn')),
                        /*
						array(
							'id' => 'display_left_other_left_right',
							'value' => 3,
							'label' => $this->l('3 columns')),
                        */
					),
                    'desc' => $this->l('CMS pages, Contact us page, Sitemap page etc.'),
                    'validation' => 'isUnsignedInt',
				), 
                array(
					'type' => 'radio',
					'label' => $this->l('Fly-out buttons:'),
					'name' => 'flyout_buttons',
					'class' => 't',
					'values' => array(
						array(
							'id' => 'flyout_buttons_on',
							'value' => 1,
							'label' => $this->l('Show it all the times')),
						array(
							'id' => 'flyout_buttons_off',
							'value' => 0,
							'label' => $this->l('Button appears on mouse-over of the product image')),
					),
                    'validation' => 'isBool',
				), 
                array(
					'type' => 'radio',
					'label' => $this->l('Show scroll to top button:'),
					'name' => 'scroll_to_top',
					'class' => 't',
					'is_bool' => true,
					'values' => array(
						array(
							'id' => 'scroll_to_top_on',
							'value' => 1,
							'label' => $this->l('Yes')),
						array(
							'id' => 'scroll_to_top_off',
							'value' => 0,
							'label' => $this->l('NO')),
					),
                    'validation' => 'isBool',
				), 
                array(
					'type' => 'radio',
					'label' => $this->l('Add to cart animation:'),
					'name' => 'addtocart_animation',
                    'default_value' => 0,
					'class' => 't',
					'values' => array(
						array(
							'id' => 'addtocart_animation_dialog',
							'value' => 0,
							'label' => $this->l('Pop-up dialog')),
						array(
							'id' => 'addtocart_animation_flying',
							'value' => 1,
							'label' => $this->l('Flying image to cart(Page scroll to top)')),
						array(
							'id' => 'addtocart_animation_flying_scroll',
							'value' => 2,
							'label' => $this->l('Flying image to cart')),
					),
                    'validation' => 'isUnsignedInt',
				), 
                array(
					'type' => 'radio',
					'label' => $this->l('Cart icon:'),
					'name' => 'cart_icon',
                    'default_value' => 0,
					'class' => 't',
					'values' => array(
						array(
							'id' => 'cart_icon_0',
							'value' => 0,
							'label' => '<i class="icon-basket"></i>'),
						array(
							'id' => 'cart_icon_1',
							'value' => 1,
							'label' => '<i class="icon-bag"></i>'),
					),
                    'validation' => 'isUnsignedInt',
				), 
                array(
					'type' => 'radio',
					'label' => $this->l('Wishlist icon:'),
					'name' => 'wishlist_icon',
                    'default_value' => 0,
					'class' => 't',
					'values' => array(
						array(
							'id' => 'wishlist_icon_0',
							'value' => 0,
							'label' => '<i class="icon-heart"></i>'),
						array(
							'id' => 'wishlist_icon_1',
							'value' => 1,
							'label' => '<i class="icon-star-1"></i>'),
					),
                    'validation' => 'isUnsignedInt',
				),
                array(
					'type' => 'radio',
					'label' => $this->l('Compare icon:'),
					'name' => 'compare_icon',
                    'default_value' => 0,
					'class' => 't',
					'values' => array(
						array(
							'id' => 'compare_icon_0',
							'value' => 0,
							'label' => '<i class="icon-ajust"></i>'),
						array(
							'id' => 'compare_icon_1',
							'value' => 1,
							'label' => '<i class="icon-exchange-1"></i>'),
					),
                    'validation' => 'isUnsignedInt',
				), 
                array(
    				'type' => 'select',
        			'label' => $this->l('Set the vertical right panel position on the screen:'),
        			'name' => 'position_right_panel',
                    'options' => array(
        				'query' => self::$position_right_panel,
        				'id' => 'id',
        				'name' => 'name',
        			),
                    'validation' => 'isGenericName',
    			),
                array(
					'type' => 'text',
					'label' => $this->l('Guest welcome msg:'),
					'name' => 'welcome',
                    'size' => 64,
                    'lang' => true,
				),
                array(
					'type' => 'text',
					'label' => $this->l('Logged welcome msg:'),
					'name' => 'welcome_logged',
                    'size' => 64,
                    'lang' => true,
				),
                array(
					'type' => 'text',
					'label' => $this->l('Add a link to welcome msg:'),
					'name' => 'welcome_link',
                    'size' => 64,
                    'lang' => true,
				),
                array(
					'type' => 'textarea',
					'label' => $this->l('Copyright text:'),
					'name' => 'copyright_text',
                    'lang' => true,
                    'required' => true,
					'cols' => 60,
					'rows' => 2,
				),
                array(
					'type' => 'text',
					'label' => $this->l('Search label:'),
					'name' => 'search_label',
                    'lang' => true,
                    'required' => true,
				),
                array(
					'type' => 'text',
					'label' => $this->l('Newsletter label:'),
					'name' => 'newsletter_label',
                    'lang' => true,
                    'required' => true,
				),
                /*
                array(
					'type' => 'color',
					'label' => $this->l('Iframe background:'),
					'name' => 'lb_bg_color',
			        'size' => 33,
                    'desc' => $this->l('Set iframe background if transparency is not allowed.'),
				),
                */
				'payment_icon' => array(
					'type' => 'file',
					'label' => $this->l('Payment icon:'),
					'name' => 'footer_image_field',
                    'desc' => '',
				),
				'icon_iphone_57_field' => array(
					'type' => 'file',
					'label' => $this->l('Iphone/iPad Favicons 57 (PNG):'),
					'name' => 'icon_iphone_57_field',
                    'desc' => '',
				),
				'icon_iphone_72_field' => array(
					'type' => 'file',
					'label' => $this->l('Iphone/iPad Favicons 72 (PNG):'),
					'name' => 'icon_iphone_72_field',
                    'desc' => '',
				),
				'icon_iphone_114_field' => array(
					'type' => 'file',
					'label' => $this->l('Iphone/iPad Favicons 114 (PNG):'),
					'name' => 'icon_iphone_114_field',
                    'desc' => '',
				),
				'icon_iphone_144_field' => array(
					'type' => 'file',
					'label' => $this->l('Iphone/iPad Favicons 144 (PNG):'),
					'name' => 'icon_iphone_144_field',
                    'desc' => '',
				),
			),
			'submit' => array(
				'title' => $this->l('   Save All   '),
				'class' => 'button'
			),
		);
        
        $this->fields_form[1]['form'] = array(
			'input' => array(
                array(
					'type' => 'radio',
					'label' => $this->l('Default product listing:'),
					'name' => 'product_view',
					'class' => 't',
					'values' => array(
						array(
							'id' => 'product_view_grid',
							'value' => 'grid_view',
							'label' => $this->l('Grid')),
						array(
							'id' => 'product_view_list',
							'value' => 'list_view',
							'label' => $this->l('List')),
					),
                    'validation' => 'isGenericName',
				),  
                array(
    				'type' => 'select',
        			'label' => $this->l('Products in a row:'),
        			'name' => 'cate_row_pro_nbr',
                    'options' => array(
        				'query' => self::$categoryRowProductNbr,
        				'id' => 'id',
        				'name' => 'name',
    					'default' => array(
    						'value' => 3,
    						'label' => 3
    					),
        			),
                    'desc' => $this->l('Category page, Speical products pages, New products page etc.'),
                    /*
                    'desc' => array(
                        $this->l('Set number of products in a row for default screen resolution(980px).'),
                        $this->l('On wide screens the number of columns will be automatically increased.'),
                    ),
                    */
                    'validation' => 'isUnsignedInt',
    			),
                array(
					'type' => 'radio',
					'label' => $this->l('Show category title on category page:'),
					'name' => 'display_category_title',
					'class' => 't',
					'is_bool' => true,
					'values' => array(
						array(
							'id' => 'display_category_title_on',
							'value' => 1,
							'label' => $this->l('Yes')),
						array(
							'id' => 'display_category_title_off',
							'value' => 0,
							'label' => $this->l('NO')),
					),
                    'validation' => 'isBool',
				), 
                array(
					'type' => 'radio',
					'label' => $this->l('Show category description on category page:'),
					'name' => 'display_category_desc',
					'class' => 't',
					'is_bool' => true,
					'values' => array(
						array(
							'id' => 'display_category_desc_on',
							'value' => 1,
							'label' => $this->l('Yes')),
						array(
							'id' => 'display_category_desc_off',
							'value' => 0,
							'label' => $this->l('NO')),
					),
                    'validation' => 'isBool',
				), 
                array(
					'type' => 'radio',
					'label' => $this->l('Show category image on category page:'),
					'name' => 'display_category_image',
					'class' => 't',
					'is_bool' => true,
					'values' => array(
						array(
							'id' => 'display_category_image_on',
							'value' => 1,
							'label' => $this->l('Yes')),
						array(
							'id' => 'display_category_image_off',
							'value' => 0,
							'label' => $this->l('NO')),
					),
                    'validation' => 'isBool',
				), 
                array(
					'type' => 'radio',
					'label' => $this->l('Show subcategories:'),
					'name' => 'display_subcate',
					'class' => 't',
					'values' => array(
						array(
							'id' => 'display_subcate_off',
							'value' => 0,
							'label' => $this->l('NO')),
						array(
							'id' => 'display_subcate_gird',
							'value' => 1,
							'label' => $this->l('Grid view')),
						array(
							'id' => 'display_subcate_list',
							'value' => 2,
							'label' => $this->l('List view')),
					),
                    'validation' => 'isUnsignedInt',
				), 
                array(
    				'type' => 'select',
        			'label' => $this->l('Subcategories per row in grid view:'),
        			'name' => 'categories_per_row',
                    'options' => array(
        				'query' => self::$categories_per_row_nbr,
        				'id' => 'id',
        				'name' => 'name',
    					'default' => array(
    						'value' => 5,
    						'label' => 5
    					),
        			),
                    'validation' => 'isUnsignedInt',
    			),
                array(
					'type' => 'radio',
					'label' => $this->l('Show product attributes:'),
					'name' => 'display_pro_attr',
					'class' => 't',
					'values' => array(
						array(
							'id' => 'display_pro_attr_off',
							'value' => 0,
							'label' => $this->l('NO')),
						array(
							'id' => 'display_pro_attr_all',
							'value' => 1,
							'label' => $this->l('All')),
						array(
							'id' => 'display_pro_attr_in_stock',
							'value' => 2,
							'label' => $this->l('In stock only')),
					),
                    'validation' => 'isUnsignedInt',
				), 
                array(
					'type' => 'radio',
					'label' => $this->l('Show the full category description on category page:'),
					'name' => 'display_cate_desc_full',
					'class' => 't',
					'is_bool' => true,
					'values' => array(
						array(
							'id' => 'display_cate_desc_full_on',
							'value' => 1,
							'label' => $this->l('Yes')),
						array(
							'id' => 'display_cate_desc_full_off',
							'value' => 0,
							'label' => $this->l('NO')),
					),
                    'validation' => 'isBool',
				), 
			),
		);
        
        $this->fields_form[2]['form'] = array(
			'input' => array(
				 array(
					'type' => 'color',
					'label' => $this->l('Body font color:'),
					'name' => 'text_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('General links color:'),
					'name' => 'link_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('General link hover color:'),
					'name' => 'link_hover_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Breadcrumb font color:'),
					'name' => 'breadcrumb_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Breadcrumb link hover color:'),
					'name' => 'breadcrumb_hover_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Breadcrumb background:'),
					'name' => 'breadcrumb_bg',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Price color:'),
					'name' => 'price_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Icon text color:'),
					'name' => 'icon_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Icon text hover color:'),
					'name' => 'icon_hover_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Icon background:'),
					'name' => 'icon_bg_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Icon hover background:'),
					'name' => 'icon_hover_bg_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Icon disabled text color:'),
					'name' => 'icon_disabled_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Right vertical panel border color:'),
					'name' => 'right_panel_border',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Starts color:'),
					'name' => 'starts_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),    
				 array(
					'type' => 'color',
					'label' => $this->l('Circle number color:'),
					'name' => 'circle_number_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),  
				 array(
					'type' => 'color',
					'label' => $this->l('Circle number background:'),
					'name' => 'circle_number_bg',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),             
				 array(
					'type' => 'color',
					'label' => $this->l('Buttons text color:'),
					'name' => 'btn_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Buttons text hover color:'),
					'name' => 'btn_hover_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
                 
				 array(
					'type' => 'color',
					'label' => $this->l('Buttons background:'),
					'name' => 'btn_bg_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Buttons background hover:'),
					'name' => 'btn_hover_bg_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Primary buttons text color:'),
					'name' => 'p_btn_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Primary buttons text hover color:'),
					'name' => 'p_btn_hover_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
                 
				 array(
					'type' => 'color',
					'label' => $this->l('Primary buttons background:'),
					'name' => 'p_btn_bg_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Primary buttons background hover:'),
					'name' => 'p_btn_hover_bg_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
            ),
        );
        
        $this->fields_form[3]['form'] = array(
			'input' => array(
                array(
					'type' => 'radio',
					'label' => $this->l('Latin extended support:'),
					'name' => 'font_latin_support',
					'class' => 't',
					'is_bool' => true,
					'values' => array(
						array(
							'id' => 'font_latin_support_on',
							'value' => 1,
							'label' => $this->l('Yes')),
						array(
							'id' => 'font_latin_support_off',
							'value' => 0,
							'label' => $this->l('NO')),
					),
                    'desc' => $this->l('You have to check your selected font whether support Latin extended here').' :<a href="http://www.google.com/webfonts">www.google.com/webfonts</a>',
                    'validation' => 'isBool',
				), 
                array(
					'type' => 'radio',
					'label' => $this->l('Cyrylic support:'),
					'name' => 'font_cyrillic_support',
					'class' => 't',
					'is_bool' => true,
					'values' => array(
						array(
							'id' => 'font_cyrillic_support_on',
							'value' => 1,
							'label' => $this->l('Yes')),
						array(
							'id' => 'font_cyrillic_support_off',
							'value' => 0,
							'label' => $this->l('NO')),
					),
                    'desc' => $this->l('You have to check your selected font whether support Cyrylic here').' :<a href="http://www.google.com/webfonts">www.google.com/webfonts</a>',
                    'validation' => 'isBool',
				),  
                array(
					'type' => 'radio',
					'label' => $this->l('Vietnamese support:'),
					'name' => 'font_vietnamese',
					'class' => 't',
					'is_bool' => true,
					'values' => array(
						array(
							'id' => 'font_vietnamese_on',
							'value' => 1,
							'label' => $this->l('Yes')),
						array(
							'id' => 'font_vietnamese_off',
							'value' => 0,
							'label' => $this->l('NO')),
					),
                    'desc' => $this->l('You have to check your selected font whether support Vietnamese here').' :<a href="http://www.google.com/webfonts">www.google.com/webfonts</a>',
                    'validation' => 'isBool',
				),  
                array(
					'type' => 'radio',
					'label' => $this->l('Greek support:'),
					'name' => 'font_greek_support',
					'class' => 't',
					'is_bool' => true,
					'values' => array(
						array(
							'id' => 'font_greek_support_on',
							'value' => 1,
							'label' => $this->l('Yes')),
						array(
							'id' => 'font_greek_support_off',
							'value' => 0,
							'label' => $this->l('NO')),
					),
                    'desc' => $this->l('You have to check your selected font whether support Greek here').' :<a href="http://www.google.com/webfonts">www.google.com/webfonts</a>',
                    'validation' => 'isBool',
				), 
				array(
					'type' => 'select',
					'label' => $this->l('Body font:'),
					'name' => 'font_text',
					'onchange' => 'handle_font_change(this,\''.implode(',',$this->systemFonts).'\');',
                    'class' => 'fontOptions',
					'options' => array(
                        'optiongroup' => array (
							'query' => $this->fontOptions(),
							'label' => 'name'
						),
						'options' => array (
							'query' => 'query',
							'id' => 'id',
							'name' => 'name'
						),
						'default' => array(
							'value' => 0,
							'label' => $this->l('Use default')
						),
					),
                    'desc' => '<p id="font_text_example" class="fontshow">Example normal text</p>',
                    'validation' => 'isGenericName',
				),
				array(
					'type' => 'select',
					'label' => $this->l('Headings font:'),
					'name' => 'font_heading',
					'onchange' => 'handle_font_change(this,\''.implode(',',$this->systemFonts).'\');',
                    'class' => 'fontOptions',
					'options' => array(
                        'optiongroup' => array (
							'query' => $this->fontOptions(),
							'label' => 'name'
						),
						'options' => array (
							'query' => 'query',
							'id' => 'id',
							'name' => 'name'
						),
						'default' => array(
							'value' => 0,
							'label' => $this->l('Use default')
						),
					),
                    'desc' => '<p id="font_heading_example" class="fontshow">Example heading</p>',
                    'validation' => 'isGenericName',
				),
				array(
					'type' => 'color',
					'label' => $this->l('Block heading color:'),
					'name' => 'block_headings_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			    ),
				array(
					'type' => 'color',
					'label' => $this->l('Heading color:'),
					'name' => 'headings_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			    ),
                array(
					'type' => 'text',
					'label' => $this->l('Headings font size(px):'),
					'name' => 'font_heading_size',
                    'validation' => 'isUnsignedInt',
				), 
                array(
					'type' => 'text',
					'label' => $this->l('Footer headings font size(px):'),
					'name' => 'footer_heading_size',
                    'validation' => 'isUnsignedInt',
				), 
                array(
					'type' => 'radio',
					'label' => $this->l('Headings font weight:'),
					'name' => 'font_heading_weight',
					'class' => 't',
					'values' => array(
						array(
							'id' => 'font_heading_weight_off',
							'value' => 0,
							'label' => $this->l('Normal')),
						array(
							'id' => 'font_heading_weight_on',
							'value' => 1,
							'label' => $this->l('Bold')),
					),
                    'validation' => 'isBool',
				),
                array(
					'type' => 'select',
        			'label' => $this->l('Headings transform:'),
        			'name' => 'font_heading_trans',
                    'options' => array(
        				'query' => self::$textTransform,
        				'id' => 'id',
        				'name' => 'name',
        			),
                    'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'select',
					'label' => $this->l('Price font:'),
					'name' => 'font_price',
					'onchange' => 'handle_font_change(this,\''.implode(',',$this->systemFonts).'\');',
                    'class' => 'fontOptions',
					'options' => array(
                        'optiongroup' => array (
							'query' => $this->fontOptions(),
							'label' => 'name'
						),
						'options' => array (
							'query' => 'query',
							'id' => 'id',
							'name' => 'name'
						),
						'default' => array(
							'value' => 0,
							'label' => $this->l('Use default')
						),
					),
                    'desc' => '<p id="font_price_example" class="fontshow">$12345.67890</p>',
                    'validation' => 'isGenericName',
				),
                array(
					'type' => 'text',
					'label' => $this->l('Price font size(px):'),
					'name' => 'font_price_size',
                    'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'select',
					'label' => $this->l('Button add to cart font:'),
					'name' => 'font_cart_btn',
					'onchange' => 'handle_font_change(this,\''.implode(',',$this->systemFonts).'\');',
                    'class' => 'fontOptions',
					'options' => array(
                        'optiongroup' => array (
							'query' => $this->fontOptions(),
							'label' => 'name'
						),
						'options' => array (
							'query' => 'query',
							'id' => 'id',
							'name' => 'name'
						),
						'default' => array(
							'value' => 0,
							'label' => $this->l('Use default')
						),
					),
                    'desc' => '<p id="font_cart_btn_example" class="fontshow">ADD TO CART</p>',
                    'validation' => 'isGenericName',
				),
            ),
        );
        
        $this->fields_form[4]['form'] = array(
			'input' => array(
				 array(
					'type' => 'color',
					'label' => $this->l('Text color:'),
					'name' => 'header_text_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Link color:'),
					'name' => 'header_link_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Link hover color:'),
					'name' => 'header_link_hover_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Link hover background:'),
					'name' => 'header_link_hover_bg',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Top header background:'),
					'name' => 'header_topbar_bg',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Top header list separators color:'),
					'name' => 'header_topbar_sep',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Dropdown text hover color:'),
					'name' => 'dropdown_hover_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Dropdown background hover:'),
					'name' => 'dropdown_bg_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
                 array(
					'type' => 'select',
        			'label' => $this->l('Select a pattern number:'),
        			'name' => 'header_bg_pattern',
                    'options' => array(
        				'query' => $this->getPatternsArray(),
        				'id' => 'id',
        				'name' => 'name',
    					'default' => array(
    						'value' => 0,
    						'label' => $this->l('None'),
    					),
        			),
                    'hint' => $this->getPatterns(),
                    'validation' => 'isUnsignedInt',
				),
				'header_bg_image_field' => array(
					'type' => 'file',
					'label' => $this->l('Upload your own pattern or background image:'),
					'name' => 'header_bg_image_field',
                    'desc' => '',
				),
                array(
					'type' => 'radio',
					'label' => $this->l('Repeat:'),
					'name' => 'header_bg_repeat',
					'class' => 't',
					'values' => array(
						array(
							'id' => 'header_bg_repeat_xy',
							'value' => 0,
							'label' => $this->l('Repeat xy')),
						array(
							'id' => 'header_bg_repeat_x',
							'value' => 1,
							'label' => $this->l('Repeat x')),
						array(
							'id' => 'header_bg_repeat_y',
							'value' => 2,
							'label' => $this->l('Repeat y')),
						array(
							'id' => 'header_bg_repeat_no',
							'value' => 3,
							'label' => $this->l('No repeat')),
					),
                    'validation' => 'isUnsignedInt',
				), 
                array(
					'type' => 'radio',
					'label' => $this->l('Position:'),
					'name' => 'header_bg_position',
					'class' => 't',
					'values' => array(
						array(
							'id' => 'header_bg_repeat_left',
							'value' => 0,
							'label' => $this->l('Left')),
						array(
							'id' => 'header_bg_repeat_center',
							'value' => 1,
							'label' => $this->l('Center')),
						array(
							'id' => 'header_bg_repeat_right',
							'value' => 2,
							'label' => $this->l('Right')),
					),
                    'validation' => 'isUnsignedInt',
				),
				 array(
					'type' => 'color',
					'label' => $this->l('Background color:'),
					'name' => 'header_bg_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Container background color:'),
					'name' => 'header_con_bg_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
            ),
        );
        
        $this->fields_form[5]['form'] = array(
			'input' => array(
				array(
					'type' => 'select',
					'label' => $this->l('Menu font:'),
					'name' => 'font_menu',
					'onchange' => 'handle_font_change(this,\''.implode(',',$this->systemFonts).'\');',
                    'class' => 'fontOptions',
					'options' => array(
                        'optiongroup' => array (
							'query' => $this->fontOptions(),
							'label' => 'name'
						),
						'options' => array (
							'query' => 'query',
							'id' => 'id',
							'name' => 'name'
						),
						'default' => array(
							'value' => 0,
							'label' => $this->l('Use default')
						),
					),
                    'desc' => '<p id="font_menu_example" class="fontshow">Home Fashion</p>',
                    'validation' => 'isGenericName',
				),
                array(
					'type' => 'text',
					'label' => $this->l('Menu font size(px):'),
					'name' => 'font_menu_size',
                    'validation' => 'isUnsignedInt',
				),
                array(
					'type' => 'radio',
					'label' => $this->l('Menu font weight:'),
					'name' => 'font_menu_weight',
					'class' => 't',
					'values' => array(
						array(
							'id' => 'font_menu_weight_off',
							'value' => 0,
							'label' => $this->l('Normal')),
						array(
							'id' => 'font_menu_weight_on',
							'value' => 1,
							'label' => $this->l('Bold')),
					),
                    'validation' => 'isBool',
				),
                array(
					'type' => 'select',
        			'label' => $this->l('Menu text transform:'),
        			'name' => 'font_menu_trans',
                    'options' => array(
        				'query' => self::$textTransform,
        				'id' => 'id',
        				'name' => 'name',
        			),
                    'validation' => 'isUnsignedInt',
				),
				 array(
					'type' => 'color',
					'label' => $this->l('Menu background:'),
					'name' => 'menu_bg_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Links color:'),
					'name' => 'menu_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Links hover color:'),
					'name' => 'menu_hover_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Links hover background:'),
					'name' => 'menu_hover_bg',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('2 level links color:'),
					'name' => 'second_menu_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('2 level links hover color:'),
					'name' => 'second_menu_hover_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('3 level links color:'),
					'name' => 'third_menu_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('3 level links hover color:'),
					'name' => 'third_menu_hover_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Mobile menu button color:'),
					'name' => 'menu_mob_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Mobile menu btton hover color:'),
					'name' => 'menu_mob_hover_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Background color for the mobile menu button:'),
					'name' => 'menu_mob_bg',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Hover background color for the mobile menu button:'),
					'name' => 'menu_mob_hover_bg',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Links color on mobile version:'),
					'name' => 'menu_mob_items1_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Level 2 links color on mobile version:'),
					'name' => 'menu_mob_items2_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Level 3 links color on mobile version:'),
					'name' => 'menu_mob_items3_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Background color on mobile version:'),
					'name' => 'menu_mob_items1_bg',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Level 2 background color on mobile version:'),
					'name' => 'menu_mob_items2_bg',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Level 3 background color on mobile version:'),
					'name' => 'menu_mob_items3_bg',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
            ),
        );
        
        $this->fields_form[6]['form'] = array(
			'input' => array(
                array(
					'type' => 'select',
        			'label' => $this->l('Select a pattern number:'),
        			'name' => 'body_bg_pattern',
                    'options' => array(
        				'query' => $this->getPatternsArray(),
        				'id' => 'id',
        				'name' => 'name',
    					'default' => array(
    						'value' => 0,
    						'label' => $this->l('None'),
    					),
        			),
                    'hint' => $this->getPatterns(),
                    'validation' => 'isUnsignedInt',
				),
				'body_bg_image_field' => array(
					'type' => 'file',
					'label' => $this->l('Upload your own pattern or background image:'),
					'name' => 'body_bg_image_field',
                    'desc' => '',
				),
                array(
					'type' => 'radio',
					'label' => $this->l('Repeat:'),
					'name' => 'body_bg_repeat',
					'class' => 't',
					'values' => array(
						array(
							'id' => 'body_bg_repeat_xy',
							'value' => 0,
							'label' => $this->l('Repeat xy')),
						array(
							'id' => 'body_bg_repeat_x',
							'value' => 1,
							'label' => $this->l('Repeat x')),
						array(
							'id' => 'body_bg_repeat_y',
							'value' => 2,
							'label' => $this->l('Repeat y')),
						array(
							'id' => 'body_bg_repeat_no',
							'value' => 3,
							'label' => $this->l('No repeat')),
					),
                    'validation' => 'isUnsignedInt',
				), 
                array(
					'type' => 'radio',
					'label' => $this->l('Position:'),
					'name' => 'body_bg_position',
					'class' => 't',
					'values' => array(
						array(
							'id' => 'body_bg_repeat_left',
							'value' => 0,
							'label' => $this->l('Left')),
						array(
							'id' => 'body_bg_repeat_center',
							'value' => 1,
							'label' => $this->l('Center')),
						array(
							'id' => 'body_bg_repeat_right',
							'value' => 2,
							'label' => $this->l('Right')),
					),
                    'validation' => 'isUnsignedInt',
				),
                array(
					'type' => 'radio',
					'label' => $this->l('Fixed background attachment:'),
					'name' => 'body_bg_fixed',
					'class' => 't',
					'is_bool' => true,
                    'default_value' => 0,
					'values' => array(
						array(
							'id' => 'body_bg_fixed_off',
							'value' => 0,
							'label' => $this->l('No')),
						array(
							'id' => 'body_bg_fixed_on',
							'value' => 1,
							'label' => $this->l('Yes')),
					),
                    'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'label' => $this->l('Body background color:'),
					'name' => 'body_bg_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
			),
		);
        
        
        $this->fields_form[7]['form'] = array(
			'input' => array(
                 array(
					'type' => 'select',
        			'label' => $this->l('Select a pattern number:'),
        			'name' => 'f_top_bg_pattern',
                    'options' => array(
        				'query' => $this->getPatternsArray(),
        				'id' => 'id',
        				'name' => 'name',
    					'default' => array(
    						'value' => 0,
    						'label' => $this->l('None'),
    					),
        			),
                    'hint' => $this->getPatterns(),
                    'validation' => 'isUnsignedInt',
				),
				'f_top_bg_image_field' => array(
					'type' => 'file',
					'label' => $this->l('Upload your own pattern or background image:'),
					'name' => 'f_top_bg_image_field',
                    'desc' => '',
				),
                array(
					'type' => 'radio',
					'label' => $this->l('Repeat:'),
					'name' => 'f_top_bg_repeat',
					'class' => 't',
					'values' => array(
						array(
							'id' => 'f_top_bg_repeat_xy',
							'value' => 0,
							'label' => $this->l('Repeat xy')),
						array(
							'id' => 'f_top_bg_repeat_x',
							'value' => 1,
							'label' => $this->l('Repeat x')),
						array(
							'id' => 'f_top_bg_repeat_y',
							'value' => 2,
							'label' => $this->l('Repeat y')),
						array(
							'id' => 'f_top_bg_repeat_no',
							'value' => 3,
							'label' => $this->l('No repeat')),
					),
                    'validation' => 'isUnsignedInt',
				), 
                array(
					'type' => 'radio',
					'label' => $this->l('Position:'),
					'name' => 'f_top_bg_position',
					'class' => 't',
					'values' => array(
						array(
							'id' => 'f_top_bg_repeat_left',
							'value' => 0,
							'label' => $this->l('Left')),
						array(
							'id' => 'f_top_bg_repeat_center',
							'value' => 1,
							'label' => $this->l('Center')),
						array(
							'id' => 'f_top_bg_repeat_right',
							'value' => 2,
							'label' => $this->l('Right')),
					),
                    'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'color',
					'label' => $this->l('Headings color:'),
					'name' => 'f_top_h_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			    ),
				 array(
					'type' => 'color',
					'label' => $this->l('border color:'),
					'name' => 'footer_top_border_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Background color:'),
					'name' => 'footer_top_bg',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Container background color:'),
					'name' => 'footer_top_con_bg',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
            ),
        );
        
        $this->fields_form[8]['form'] = array(
			'input' => array(
				 array(
					'type' => 'color',
					'label' => $this->l('Font color:'),
					'name' => 'footer_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Links color:'),
					'name' => 'footer_link_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Links hover color:'),
					'name' => 'footer_link_hover_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
                 array(
					'type' => 'select',
        			'label' => $this->l('Select a pattern number:'),
        			'name' => 'footer_bg_pattern',
                    'options' => array(
        				'query' => $this->getPatternsArray(),
        				'id' => 'id',
        				'name' => 'name',
    					'default' => array(
    						'value' => 0,
    						'label' => $this->l('None'),
    					),
        			),
                    'hint' => $this->getPatterns(),
                    'validation' => 'isUnsignedInt',
				),
				'footer_bg_image_field' => array(
					'type' => 'file',
					'label' => $this->l('Upload your own pattern or background image:'),
					'name' => 'footer_bg_image_field',
                    'desc' => '',
				),
                array(
					'type' => 'radio',
					'label' => $this->l('Repeat:'),
					'name' => 'footer_bg_repeat',
					'class' => 't',
					'values' => array(
						array(
							'id' => 'footer_bg_repeat_xy',
							'value' => 0,
							'label' => $this->l('Repeat xy')),
						array(
							'id' => 'footer_bg_repeat_x',
							'value' => 1,
							'label' => $this->l('Repeat x')),
						array(
							'id' => 'footer_bg_repeat_y',
							'value' => 2,
							'label' => $this->l('Repeat y')),
						array(
							'id' => 'footer_bg_repeat_no',
							'value' => 3,
							'label' => $this->l('No repeat')),
					),
                    'validation' => 'isUnsignedInt',
				), 
                array(
					'type' => 'radio',
					'label' => $this->l('Position:'),
					'name' => 'footer_bg_position',
					'class' => 't',
					'values' => array(
						array(
							'id' => 'footer_bg_repeat_left',
							'value' => 0,
							'label' => $this->l('Left')),
						array(
							'id' => 'footer_bg_repeat_center',
							'value' => 1,
							'label' => $this->l('Center')),
						array(
							'id' => 'footer_bg_repeat_right',
							'value' => 2,
							'label' => $this->l('Right')),
					),
                    'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'color',
					'label' => $this->l('Headings color:'),
					'name' => 'footer_h_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			    ),
				 array(
					'type' => 'color',
					'label' => $this->l('Background color:'),
					'name' => 'footer_bg_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Container background color:'),
					'name' => 'footer_con_bg_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Footer border color:'),
					'name' => 'footer_border_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),        
            ),
        );
        
        $this->fields_form[9]['form'] = array(
			'input' => array(
                 array(
					'type' => 'select',
        			'label' => $this->l('Select a pattern number:'),
        			'name' => 'f_secondary_bg_pattern',
                    'options' => array(
        				'query' => $this->getPatternsArray(),
        				'id' => 'id',
        				'name' => 'name',
    					'default' => array(
    						'value' => 0,
    						'label' => $this->l('None'),
    					),
        			),
                    'hint' => $this->getPatterns(),
                    'validation' => 'isUnsignedInt',
				),
				'f_secondary_bg_image_field' => array(
					'type' => 'file',
					'label' => $this->l('Upload your own pattern or background image:'),
					'name' => 'f_secondary_bg_image_field',
                    'desc' => '',
				),
                array(
					'type' => 'radio',
					'label' => $this->l('Repeat:'),
					'name' => 'f_secondary_bg_repeat',
					'class' => 't',
					'values' => array(
						array(
							'id' => 'f_secondary_bg_repeat_xy',
							'value' => 0,
							'label' => $this->l('Repeat xy')),
						array(
							'id' => 'f_secondary_bg_repeat_x',
							'value' => 1,
							'label' => $this->l('Repeat x')),
						array(
							'id' => 'f_secondary_bg_repeat_y',
							'value' => 2,
							'label' => $this->l('Repeat y')),
						array(
							'id' => 'f_secondary_bg_repeat_no',
							'value' => 3,
							'label' => $this->l('No repeat')),
					),
                    'validation' => 'isUnsignedInt',
				), 
                array(
					'type' => 'radio',
					'label' => $this->l('Position:'),
					'name' => 'f_secondary_bg_position',
					'class' => 't',
					'values' => array(
						array(
							'id' => 'f_secondary_bg_repeat_left',
							'value' => 0,
							'label' => $this->l('Left')),
						array(
							'id' => 'f_secondary_bg_repeat_center',
							'value' => 1,
							'label' => $this->l('Center')),
						array(
							'id' => 'f_secondary_bg_repeat_right',
							'value' => 2,
							'label' => $this->l('Right')),
					),
                    'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'color',
					'label' => $this->l('Headings color:'),
					'name' => 'f_secondary_h_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			    ),
				 array(
					'type' => 'color',
					'label' => $this->l('Background color:'),
					'name' => 'footer_secondary_bg',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Container background color:'),
					'name' => 'footer_secondary_con_bg',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
        
            ),
        );
        
        $this->fields_form[11]['form'] = array(
			'input' => array(
                 array(
					'type' => 'select',
        			'label' => $this->l('Select a pattern number:'),
        			'name' => 'f_info_bg_pattern',
                    'options' => array(
        				'query' => $this->getPatternsArray(),
        				'id' => 'id',
        				'name' => 'name',
    					'default' => array(
    						'value' => 0,
    						'label' => $this->l('None'),
    					),
        			),
                    'hint' => $this->getPatterns(),
                    'validation' => 'isUnsignedInt',
				),
				'f_info_bg_image_field' => array(
					'type' => 'file',
					'label' => $this->l('Upload your own pattern or background image:'),
					'name' => 'f_info_bg_image_field',
                    'desc' => '',
				),
                array(
					'type' => 'radio',
					'label' => $this->l('Repeat:'),
					'name' => 'f_info_bg_repeat',
					'class' => 't',
					'values' => array(
						array(
							'id' => 'f_info_bg_repeat_xy',
							'value' => 0,
							'label' => $this->l('Repeat xy')),
						array(
							'id' => 'f_info_bg_repeat_x',
							'value' => 1,
							'label' => $this->l('Repeat x')),
						array(
							'id' => 'f_info_bg_repeat_y',
							'value' => 2,
							'label' => $this->l('Repeat y')),
						array(
							'id' => 'f_info_bg_repeat_no',
							'value' => 3,
							'label' => $this->l('No repeat')),
					),
                    'validation' => 'isUnsignedInt',
				), 
                array(
					'type' => 'radio',
					'label' => $this->l('Position:'),
					'name' => 'f_info_bg_position',
					'class' => 't',
					'values' => array(
						array(
							'id' => 'f_info_bg_repeat_left',
							'value' => 0,
							'label' => $this->l('Left')),
						array(
							'id' => 'f_info_bg_repeat_center',
							'value' => 1,
							'label' => $this->l('Center')),
						array(
							'id' => 'f_info_bg_repeat_right',
							'value' => 2,
							'label' => $this->l('Right')),
					),
                    'validation' => 'isUnsignedInt',
				),
				 array(
					'type' => 'color',
					'label' => $this->l('Background color:'),
					'name' => 'footer_info_bg',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Container background color:'),
					'name' => 'footer_info_con_bg',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Font color:'),
					'name' => 'second_footer_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
            ),
        );
        
        $this->fields_form[10]['form'] = array(
			'legend' => array(
				'title' => $this->l('Cross selling'),
			),
			'input' => array(
                array(
					'type' => 'select',
        			'label' => $this->l('The number of columns:'),
        			'name' => 'cs_items',
                    'options' => array(
        				'query' => self::$items,
        				'id' => 'id',
        				'name' => 'name',
        			),
                    'desc' => $this->l('Set number of columns for default screen resolution(980px).'),
                    'validation' => 'isUnsignedInt',
				), 
                array(
					'type' => 'radio',
					'label' => $this->l('Autoplay:'),
					'name' => 'cs_slideshow',
					'class' => 't',
					'is_bool' => true,
                    'default_value' => 1,
					'values' => array(
						array(
							'id' => 'cs_slide_on',
							'value' => 1,
							'label' => $this->l('Yes')),
						array(
							'id' => 'cs_slide_off',
							'value' => 0,
							'label' => $this->l('No')),
					),
                    'validation' => 'isBool',
				), 
                array(
					'type' => 'text',
					'label' => $this->l('Time:'),
					'name' => 'cs_s_speed',
                    'default_value' => 7000,
                    'desc' => $this->l('The period, in milliseconds, between the end of a transition effect and the start of the next one.'),
                    'validation' => 'isUnsignedInt',
				),
                array(
					'type' => 'text',
					'label' => $this->l('Transition period:'),
					'name' => 'cs_a_speed',
                    'default_value' => 400,
                    'desc' => $this->l('The period, in milliseconds, of the transition effect.'),
                    'validation' => 'isUnsignedInt',
				),
                array(
					'type' => 'radio',
					'label' => $this->l('Pause On Hover:'),
					'name' => 'cs_pause_on_hover',
                    'default_value' => 1,
					'class' => 't',
					'is_bool' => true,
					'values' => array(
						array(
							'id' => 'cs_pause_on_hover_on',
							'value' => 1,
							'label' => $this->l('Yes')),
						array(
							'id' => 'cs_pause_on_hover_off',
							'value' => 0,
							'label' => $this->l('No')),
					),
                    'validation' => 'isBool',
				),
                array(
					'type' => 'select',
        			'label' => $this->l('Easing method:'),
        			'name' => 'cs_easing',
                    'options' => array(
        				'query' => self::$easing,
        				'id' => 'id',
        				'name' => 'name',
        			),
                    'desc' => $this->l('The type of easing applied to the transition animation'),
                    'validation' => 'isUnsignedInt',
				), 
                array(
					'type' => 'radio',
					'label' => $this->l('Loop:'),
					'name' => 'cs_loop',
                    'default_value' => 0,
					'class' => 't',
					'is_bool' => true,
					'values' => array(
						array(
							'id' => 'cs_loop_on',
							'value' => 1,
							'label' => $this->l('Yes')),
						array(
							'id' => 'cs_loop_off',
							'value' => 0,
							'label' => $this->l('No')),
					),
                    'desc' => $this->l('"No" if you want to perform the animation once; "Yes" to loop the animation'),
                    'validation' => 'isBool',
				),
                array(
					'type' => 'radio',
					'label' => $this->l('Move:'),
					'name' => 'cs_move',
                    'default_value' => 0,
					'class' => 't',
					'values' => array(
						array(
							'id' => 'cs_move_on',
							'value' => 1,
							'label' => $this->l('1 item')),
						array(
							'id' => 'cs_move_off',
							'value' => 0,
							'label' => $this->l('All visible items')),
					),
                    'validation' => 'isBool',
				),
            ),
        );
        
        
        $this->fields_form[12]['form'] = array(
			'legend' => array(
				'title' => $this->l('Products category'),
			),
			'input' => array(
                array(
					'type' => 'select',
        			'label' => $this->l('The number of columns:'),
        			'name' => 'pc_items',
                    'options' => array(
        				'query' => self::$items,
        				'id' => 'id',
        				'name' => 'name',
        			),
                    'desc' => $this->l('Set number of columns for default screen resolution(980px).'),
                    'validation' => 'isUnsignedInt',
				), 
                array(
					'type' => 'radio',
					'label' => $this->l('Autoplay:'),
					'name' => 'pc_slideshow',
					'class' => 't',
					'is_bool' => true,
                    'default_value' => 1,
					'values' => array(
						array(
							'id' => 'pc_slide_on',
							'value' => 1,
							'label' => $this->l('Yes')),
						array(
							'id' => 'pc_slide_off',
							'value' => 0,
							'label' => $this->l('No')),
					),
                    'validation' => 'isBool',
				), 
                array(
					'type' => 'text',
					'label' => $this->l('Time:'),
					'name' => 'pc_s_speed',
                    'default_value' => 7000,
                    'desc' => $this->l('The period, in milliseconds, between the end of a transition effect and the start of the next one.'),
                    'validation' => 'isUnsignedInt',
				),
                array(
					'type' => 'text',
					'label' => $this->l('Transition period:'),
					'name' => 'pc_a_speed',
                    'default_value' => 400,
                    'desc' => $this->l('The period, in milliseconds, of the transition effect.'),
                    'validation' => 'isUnsignedInt',
				),
                array(
					'type' => 'radio',
					'label' => $this->l('Pause On Hover:'),
					'name' => 'pc_pause_on_hover',
                    'default_value' => 1,
					'class' => 't',
					'is_bool' => true,
					'values' => array(
						array(
							'id' => 'pc_pause_on_hover_on',
							'value' => 1,
							'label' => $this->l('Yes')),
						array(
							'id' => 'pc_pause_on_hover_off',
							'value' => 0,
							'label' => $this->l('No')),
					),
                    'validation' => 'isBool',
				),
                array(
					'type' => 'select',
        			'label' => $this->l('Easing method:'),
        			'name' => 'pc_easing',
                    'options' => array(
        				'query' => self::$easing,
        				'id' => 'id',
        				'name' => 'name',
        			),
                    'desc' => $this->l('The type of easing applied to the transition animation'),
                    'validation' => 'isUnsignedInt',
				), 
                array(
					'type' => 'radio',
					'label' => $this->l('Loop:'),
					'name' => 'pc_loop',
                    'default_value' => 0,
					'class' => 't',
					'is_bool' => true,
					'values' => array(
						array(
							'id' => 'pc_loop_on',
							'value' => 1,
							'label' => $this->l('Yes')),
						array(
							'id' => 'pc_loop_off',
							'value' => 0,
							'label' => $this->l('No')),
					),
                    'desc' => $this->l('"No" if you want to perform the animation once; "Yes" to loop the animation'),
                    'validation' => 'isBool',
				),
                array(
					'type' => 'radio',
					'label' => $this->l('Move:'),
					'name' => 'pc_move',
                    'default_value' => 0,
					'class' => 't',
					'values' => array(
						array(
							'id' => 'pc_move_on',
							'value' => 1,
							'label' => $this->l('1 item')),
						array(
							'id' => 'pc_move_off',
							'value' => 0,
							'label' => $this->l('All visible items')),
					),
                    'validation' => 'isBool',
				),
            ),
        );
        
        $this->fields_form[13]['form'] = array(
			'legend' => array(
				'title' => $this->l('Accessories'),
			),
			'input' => array(
                array(
					'type' => 'select',
        			'label' => $this->l('The number of columns:'),
        			'name' => 'ac_items',
                    'options' => array(
        				'query' => self::$items,
        				'id' => 'id',
        				'name' => 'name',
        			),
                    'desc' => $this->l('Set number of columns for default screen resolution(980px).'),
                    'validation' => 'isUnsignedInt',
				), 
                array(
					'type' => 'radio',
					'label' => $this->l('Autoplay:'),
					'name' => 'ac_slideshow',
					'class' => 't',
					'is_bool' => true,
                    'default_value' => 1,
					'values' => array(
						array(
							'id' => 'ac_slide_on',
							'value' => 1,
							'label' => $this->l('Yes')),
						array(
							'id' => 'ac_slide_off',
							'value' => 0,
							'label' => $this->l('No')),
					),
                    'validation' => 'isBool',
				), 
                array(
					'type' => 'text',
					'label' => $this->l('Time:'),
					'name' => 'ac_s_speed',
                    'default_value' => 7000,
                    'desc' => $this->l('The period, in milliseconds, between the end of a transition effect and the start of the next one.'),
                    'validation' => 'isUnsignedInt',
				),
                array(
					'type' => 'text',
					'label' => $this->l('Transition period:'),
					'name' => 'ac_a_speed',
                    'default_value' => 400,
                    'desc' => $this->l('The period, in milliseconds, of the transition effect.'),
                    'validation' => 'isUnsignedInt',
				),
                array(
					'type' => 'radio',
					'label' => $this->l('Pause On Hover:'),
					'name' => 'ac_pause_on_hover',
                    'default_value' => 1,
					'class' => 't',
					'is_bool' => true,
					'values' => array(
						array(
							'id' => 'ac_pause_on_hover_on',
							'value' => 1,
							'label' => $this->l('Yes')),
						array(
							'id' => 'ac_pause_on_hover_off',
							'value' => 0,
							'label' => $this->l('No')),
					),
                    'validation' => 'isBool',
				),
                array(
					'type' => 'select',
        			'label' => $this->l('Easing method:'),
        			'name' => 'ac_easing',
                    'options' => array(
        				'query' => self::$easing,
        				'id' => 'id',
        				'name' => 'name',
        			),
                    'desc' => $this->l('The type of easing applied to the transition animation'),
                    'validation' => 'isUnsignedInt',
				), 
                array(
					'type' => 'radio',
					'label' => $this->l('Loop:'),
					'name' => 'ac_loop',
                    'default_value' => 0,
					'class' => 't',
					'is_bool' => true,
					'values' => array(
						array(
							'id' => 'ac_loop_on',
							'value' => 1,
							'label' => $this->l('Yes')),
						array(
							'id' => 'ac_loop_off',
							'value' => 0,
							'label' => $this->l('No')),
					),
                    'desc' => $this->l('"No" if you want to perform the animation once; "Yes" to loop the animation'),
                    'validation' => 'isBool',
				),
                array(
					'type' => 'radio',
					'label' => $this->l('Move:'),
					'name' => 'ac_move',
                    'default_value' => 0,
					'class' => 't',
					'values' => array(
						array(
							'id' => 'ac_move_on',
							'value' => 1,
							'label' => $this->l('1 item')),
						array(
							'id' => 'ac_move_off',
							'value' => 0,
							'label' => $this->l('All visible items')),
					),
                    'validation' => 'isBool',
				),
            ),
        );
        
        
        $this->fields_form[14]['form'] = array(
			'legend' => array(
				'title' => $this->l('Bestsellers'),
			),
			'input' => array(
                array(
					'type' => 'select',
        			'label' => $this->l('The number of columns:'),
        			'name' => 'bs_items',
                    'options' => array(
        				'query' => self::$items,
        				'id' => 'id',
        				'name' => 'name',
        			),
                    'desc' => $this->l('Set number of columns for default screen resolution(980px).'),
                    'validation' => 'isUnsignedInt',
				), 
                array(
					'type' => 'radio',
					'label' => $this->l('Autoplay:'),
					'name' => 'bs_slideshow',
					'class' => 't',
					'is_bool' => true,
                    'default_value' => 1,
					'values' => array(
						array(
							'id' => 'bs_slide_on',
							'value' => 1,
							'label' => $this->l('Yes')),
						array(
							'id' => 'bs_slide_off',
							'value' => 0,
							'label' => $this->l('No')),
					),
                    'validation' => 'isBool',
				), 
                array(
					'type' => 'text',
					'label' => $this->l('Time:'),
					'name' => 'bs_s_speed',
                    'default_value' => 7000,
                    'desc' => $this->l('The period, in milliseconds, between the end of a transition effect and the start of the next one.'),
                    'validation' => 'isUnsignedInt',
				),
                array(
					'type' => 'text',
					'label' => $this->l('Transition period:'),
					'name' => 'bs_a_speed',
                    'default_value' => 400,
                    'desc' => $this->l('The period, in milliseconds, of the transition effect.'),
                    'validation' => 'isUnsignedInt',
				),
                array(
					'type' => 'radio',
					'label' => $this->l('Pause On Hover:'),
					'name' => 'bs_pause_on_hover',
                    'default_value' => 1,
					'class' => 't',
					'is_bool' => true,
					'values' => array(
						array(
							'id' => 'bs_pause_on_hover_on',
							'value' => 1,
							'label' => $this->l('Yes')),
						array(
							'id' => 'bs_pause_on_hover_off',
							'value' => 0,
							'label' => $this->l('No')),
					),
                    'validation' => 'isBool',
				),
                array(
					'type' => 'select',
        			'label' => $this->l('Easing method:'),
        			'name' => 'bs_easing',
                    'options' => array(
        				'query' => self::$easing,
        				'id' => 'id',
        				'name' => 'name',
        			),
                    'desc' => $this->l('The type of easing applied to the transition animation'),
                    'validation' => 'isUnsignedInt',
				), 
                array(
					'type' => 'radio',
					'label' => $this->l('Loop:'),
					'name' => 'bs_loop',
                    'default_value' => 0,
					'class' => 't',
					'is_bool' => true,
					'values' => array(
						array(
							'id' => 'bs_loop_on',
							'value' => 1,
							'label' => $this->l('Yes')),
						array(
							'id' => 'bs_loop_off',
							'value' => 0,
							'label' => $this->l('No')),
					),
                    'desc' => $this->l('"No" if you want to perform the animation once; "Yes" to loop the animation'),
                    'validation' => 'isBool',
				),
                array(
					'type' => 'radio',
					'label' => $this->l('Move:'),
					'name' => 'bs_move',
                    'default_value' => 0,
					'class' => 't',
					'values' => array(
						array(
							'id' => 'bs_move_on',
							'value' => 1,
							'label' => $this->l('1 item')),
						array(
							'id' => 'bs_move_off',
							'value' => 0,
							'label' => $this->l('All visible items')),
					),
                    'validation' => 'isBool',
				),
            ),
        );
        
        $this->fields_form[15]['form'] = array(
			'input' => array(
                array(
					'type' => 'textarea',
					'label' => $this->l('Custom CSS Code:'),
					'name' => 'custom_css',
					'cols' => 80,
					'rows' => 10,
                    'desc' => $this->l('Override css with your custom code'),
                    'validation' => 'isAnything',
				),
                array(
					'type' => 'textarea',
					'label' => $this->l('Custom JAVASCRIPT Code:'),
					'name' => 'custom_js',
					'cols' => 80,
					'rows' => 10,
                    'desc' => $this->l('Override js with your custom code'),
                    'validation' => 'isAnything',
				),
                array(
					'type' => 'textarea',
					'label' => $this->l('Tracking code:'),
					'name' => 'tracking_code',
					'cols' => 80,
					'rows' => 10,
                    'validation' => 'isAnything',
				),
            ),
        );
        
        $this->fields_form[16]['form'] = array(
			'input' => array(
                array(
					'type' => 'radio',
					'label' => $this->l('New stickers style:'),
					'name' => 'new_style',
					'class' => 't',
					'values' => array(
						array(
							'id' => 'new_style_flag',
							'value' => 0,
							'label' => $this->l('Flag')),
						array(
							'id' => 'new_style_circle',
							'value' => 1,
							'label' => $this->l('Circle')),
					),
                    'validation' => 'isUnsignedInt',
				), 
				 array(
					'type' => 'color',
					'label' => $this->l('New stickers color:'),
					'name' => 'new_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('New stickers background color:'),
					'name' => 'new_bg_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				'new_bg_image_field' => array(
					'type' => 'file',
					'label' => $this->l('New stickers background image(only for circle stickers):'),
					'name' => 'new_bg_image_field',
                    'desc' => '',
				),
                array(
					'type' => 'text',
					'label' => $this->l('New stickers width(px):'),
					'name' => 'new_stickers_width',
                    'validation' => 'isUnsignedInt',
				),
                array(
					'type' => 'text',
					'label' => $this->l('New stickers top postion(px):'),
					'name' => 'new_stickers_top',
                    'validation' => 'isUnsignedInt',
				),
                array(
					'type' => 'text',
					'label' => $this->l('New stickers right postion(px):'),
					'name' => 'new_stickers_right',
                    'validation' => 'isUnsignedInt',
				),
                array(
					'type' => 'radio',
					'label' => $this->l('Sale stickers style:'),
					'name' => 'sale_style',
					'class' => 't',
					'values' => array(
						array(
							'id' => 'sale_style_flag',
							'value' => 0,
							'label' => $this->l('Flag')),
						array(
							'id' => 'sale_style_circle',
							'value' => 1,
							'label' => $this->l('Circle')),
					),
                    'validation' => 'isUnsignedInt',
				), 
				 array(
					'type' => 'color',
					'label' => $this->l('Sale stickers color:'),
					'name' => 'sale_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Sale stickers background color:'),
					'name' => 'sale_bg_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),   
				'sale_bg_image_field' => array(
					'type' => 'file',
					'label' => $this->l('Sale stickers sticker image(only for circle stickers):'),
					'name' => 'sale_bg_image_field',
                    'desc' => '',
				),
                array(
					'type' => 'text',
					'label' => $this->l('Sale stickers width(px):'),
					'name' => 'sale_stickers_width',
                    'validation' => 'isUnsignedInt',
				),
                array(
					'type' => 'text',
					'label' => $this->l('Sale stickers top postion(px):'),
					'name' => 'sale_stickers_top',
                    'validation' => 'isUnsignedInt',
				),
                array(
					'type' => 'text',
					'label' => $this->l('Sale stickers left postion(px):'),
					'name' => 'sale_stickers_left',
                    'validation' => 'isUnsignedInt',
				),
                array(
					'type' => 'radio',
					'label' => $this->l('Show price drop percentage/amount:'),
					'name' => 'discount_percentage',
					'class' => 't',
					'values' => array(
						array(
							'id' => 'discount_percentage_off',
							'value' => 0,
							'label' => $this->l('No')),
						array(
							'id' => 'discount_percentage_text',
							'value' => 1,
							'label' => $this->l('Text')),
						array(
							'id' => 'discount_percentage_sticker',
							'value' => 2,
							'label' => $this->l('Sticker')),
					),
                    'validation' => 'isUnsignedInt',
				), 
				 array(
					'type' => 'color',
					'label' => $this->l('Price drop stickers text color:'),
					'name' => 'price_drop_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Price drop stickers border color:'),
					'name' => 'price_drop_border_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
				 array(
					'type' => 'color',
					'label' => $this->l('Price drop stickers background color:'),
					'name' => 'price_drop_bg_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			     ),
                array(
					'type' => 'text',
					'label' => $this->l('Price drop stickers bottom postion(px):'),
					'name' => 'price_drop_bottom',
                    'validation' => 'isUnsignedInt',
				),
                array(
					'type' => 'text',
					'label' => $this->l('Price drop stickers right postion(px):'),
					'name' => 'price_drop_right',
                    'validation' => 'isUnsignedInt',
				),  
                array(
					'type' => 'text',
					'label' => $this->l('Price drop stickers width(px):'),
					'name' => 'price_drop_width',
                    'validation' => 'isUnsignedInt',
                    'desc' => $this->l('Number of width must be greater than 28'),
				),           
            ),
        );
        
        
        $this->fields_form[17]['form'] = array(
			'input' => array(
                array(
					'type' => 'radio',
					'label' => $this->l('Show product secondary column:'),
					'name' => 'product_secondary',
					'class' => 't',
					'is_bool' => true,
					'values' => array(
						array(
							'id' => 'product_secondary_on',
							'value' => 1,
							'label' => $this->l('Enable')),
						array(
							'id' => 'product_secondary_off',
							'value' => 0,
							'label' => $this->l('Disabled')),
					),
                    'desc' => $this->l('Only for product page is 1 column layout'),
                    'validation' => 'isBool',
				), 
                array(
					'type' => 'radio',
					'label' => $this->l('Show brand logo on product page:'),
					'name' => 'show_brand_logo',
					'class' => 't',
					'is_bool' => true,
					'values' => array(
						array(
							'id' => 'show_brand_logo_on',
							'value' => 1,
							'label' => $this->l('Enable')),
						array(
							'id' => 'show_brand_logo_off',
							'value' => 0,
							'label' => $this->l('Disabled')),
					),
                    'desc' => $this->l('Brand logo on product secondary column'),
                    'validation' => 'isBool',
				), 
                array(
					'type' => 'radio',
					'label' => $this->l('Display tax label:'),
					'name' => 'display_tax_label',
					'class' => 't',
					'is_bool' => true,
					'values' => array(
						array(
							'id' => 'display_tax_label_on',
							'value' => 1,
							'label' => $this->l('Enable')),
						array(
							'id' => 'display_tax_label_off',
							'value' => 0,
							'label' => $this->l('Disabled')),
					),
                    'desc' => array(
                        $this->l('Set number of products in a row for default screen resolution(980px).'),
                        $this->l('On wide screens the number of columns will be automatically increased.'),
                    ),
                    'desc' => $this->l('In order to display the tax incl label, you need to activate taxes (Localization -> taxes -> Enable tax), make sure your country displays the label (Localization -> countries -> select your country -> display tax label) and to make sure the group of the customer is set to display price with taxes (BackOffice -> customers -> groups).'),
                    'validation' => 'isBool',
				), 
                array(
    				'type' => 'select',
        			'label' => $this->l('Pack items in a row(in prodcut page):'),
        			'name' => 'pack_row_pro_nbr',
                    'options' => array(
        				'query' => self::$categoryRowProductNbr,
        				'id' => 'id',
        				'name' => 'name',
    					'default' => array(
    						'value' => 3,
    						'label' => 3
    					),
        			),
                    /*
                    'desc' => array(
                        $this->l('Set number of products in a row for default screen resolution(980px).'),
                        $this->l('On wide screens the number of columns will be automatically increased.'),
                    ),
                    */
                    'validation' => 'isUnsignedInt',
    			),
                array(
					'type' => 'radio',
					'label' => $this->l('Google rich snippets:'),
					'name' => 'google_rich_snippets',
                    'default_value' => 1,
					'class' => 't',
					'values' => array(
						array(
							'id' => 'google_rich_snippets_disable',
							'value' => 0,
							'label' => $this->l('Disable')),
						array(
							'id' => 'google_rich_snippets_enable',
							'value' => 1,
							'label' => $this->l('Enable')),
						array(
							'id' => 'google_rich_snippets_except_for_review_aggregate',
							'value' => 2,
							'label' => $this->l('Enable except for Review-aggregate')),
					),
                    'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'color',
					'label' => $this->l('Tab color:'),
					'name' => 'pro_tab_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			    ),
				array(
					'type' => 'color',
					'label' => $this->l('Active tab color:'),
					'name' => 'pro_tab_active_color',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			    ),
				array(
					'type' => 'color',
					'label' => $this->l('Tab background:'),
					'name' => 'pro_tab_bg',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			    ),
				array(
					'type' => 'color',
					'label' => $this->l('Active tab background:'),
					'name' => 'pro_tab_active_bg',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			    ),
				array(
					'type' => 'color',
					'label' => $this->l('Tab content background:'),
					'name' => 'pro_tab_content_bg',
					'class' => 'color',
					'size' => 20,
                    'validation' => 'isColor',
			    ),
			),
		);
    }
	
    protected function initForm()
	{
		$default_lang = (int)Configuration::get('PS_LANG_DEFAULT');


        $footer_img = Configuration::get('STSN_FOOTER_IMG');
		if ($footer_img != "") {
		    $this->fields_form[0]['form']['input']['payment_icon']['desc'] = '<div><img class="img_preview" src="'.($footer_img!=$this->defaults["footer_img"] ? _THEME_PROD_PIC_DIR_.$footer_img : $this->_path.$footer_img).'" /><a href="javascript:;" id="footer_img" class="delete_image">'.$this->l('Delete image').'</a></div>';
		}
		if (Configuration::get('STSN_ICON_IPHONE_57') != "") {
		    $this->fields_form[0]['form']['input']['icon_iphone_57_field']['desc'] = '<div><img class="img_preview" src="'.($this->_path.Configuration::get('STSN_ICON_IPHONE_57')).'" /><a href="javascript:;" id="icon_iphone_57" class="delete_image">'.$this->l('Delete image').'</a></div>';
		}
		if (Configuration::get('STSN_ICON_IPHONE_72') != "") {
		    $this->fields_form[0]['form']['input']['icon_iphone_72_field']['desc'] = '<div><img class="img_preview" src="'.($this->_path.Configuration::get('STSN_ICON_IPHONE_72')).'" /><a href="javascript:;" id="icon_iphone_72" class="delete_image">'.$this->l('Delete image').'</a></div>';
		}
		if (Configuration::get('STSN_ICON_IPHONE_114') != "") {
		    $this->fields_form[0]['form']['input']['icon_iphone_114_field']['desc'] = '<div><img class="img_preview" src="'.($this->_path.Configuration::get('STSN_ICON_IPHONE_114')).'" /><a href="javascript:;" id="icon_iphone_114" class="delete_image">'.$this->l('Delete image').'</a></div>';
		}
		if (Configuration::get('STSN_ICON_IPHONE_144') != "") {
		    $this->fields_form[0]['form']['input']['icon_iphone_144_field']['desc'] = '<div><img class="img_preview" src="'.($this->_path.Configuration::get('STSN_ICON_IPHONE_144')).'" /><a href="javascript:;" id="icon_iphone_144" class="delete_image">'.$this->l('Delete image').'</a></div>';
		}
        
		if (Configuration::get('STSN_HEADER_BG_IMG') != "") {
		    $this->fields_form[4]['form']['input']['header_bg_image_field']['desc'] = '<div><img class="img_preview" src="'.($this->_path.Configuration::get('STSN_HEADER_BG_IMG')).'" /><a href="javascript:;" id="header_bg_img" class="delete_image">'.$this->l('Delete image').'</a></div>';
		}
		if (Configuration::get('STSN_BODY_BG_IMG') != "") {
		    $this->fields_form[6]['form']['input']['body_bg_image_field']['desc'] = '<div><img class="img_preview" src="'.($this->_path.Configuration::get('STSN_BODY_BG_IMG')).'" /><a href="javascript:;" id="body_bg_img" class="delete_image">'.$this->l('Delete image').'</a></div>';
		}
		if (Configuration::get('STSN_F_TOP_BG_IMG') != "") {
		    $this->fields_form[7]['form']['input']['f_top_bg_image_field']['desc'] = '<div><img class="img_preview" src="'.($this->_path.Configuration::get('STSN_F_TOP_BG_IMG')).'" /><a href="javascript:;" id="f_top_bg_img" class="delete_image">'.$this->l('Delete image').'</a></div>';
		}
		if (Configuration::get('STSN_FOOTER_BG_IMG') != "") {
		    $this->fields_form[8]['form']['input']['footer_bg_image_field']['desc'] = '<div><img class="img_preview" src="'.($this->_path.Configuration::get('STSN_FOOTER_BG_IMG')).'" /><a href="javascript:;" id="footer_bg_img" class="delete_image">'.$this->l('Delete image').'</a></div>';
		}
		if (Configuration::get('STSN_F_SECONDARY_BG_IMG') != "") {
		    $this->fields_form[9]['form']['input']['f_secondary_bg_image_field']['desc'] = '<div><img class="img_preview" src="'.($this->_path.Configuration::get('STSN_F_SECONDARY_BG_IMG')).'" /><a href="javascript:;" id="f_secondary_bg_img" class="delete_image">'.$this->l('Delete image').'</a></div>';
		}
		if (Configuration::get('STSN_F_INFO_BG_IMG') != "") {
		    $this->fields_form[10]['form']['input']['f_info_bg_image_field']['desc'] = '<div><img class="img_preview" src="'.($this->_path.Configuration::get('STSN_F_INFO_BG_IMG')).'" /><a href="javascript:;" id="f_info_bg_img" class="delete_image">'.$this->l('Delete image').'</a></div>';
		}
		if (Configuration::get('STSN_NEW_BG_IMG') != "") {
		    $this->fields_form[16]['form']['input']['new_bg_image_field']['desc'] = '<div><img class="img_preview" src="'.($this->_path.Configuration::get('STSN_NEW_BG_IMG')).'" /><a href="javascript:;" id="new_bg_img" class="delete_image">'.$this->l('Delete image').'</a></div>';
		}
		if (Configuration::get('STSN_SALE_BG_IMG') != "") {
		    $this->fields_form[16]['form']['input']['sale_bg_image_field']['desc'] = '<div><img class="img_preview" src="'.($this->_path.Configuration::get('STSN_SALE_BG_IMG')).'" /><a href="javascript:;" id="sale_bg_img" class="delete_image">'.$this->l('Delete image').'</a></div>';
		}
        if(!Configuration::get('STSN_LOGO_POSITION'))
            $this->fields_form[0]['form']['input']['logo_height']['disabled']=true;           
        
		$helper = new HelperForm();
		$helper->module = $this;
		$helper->name_controller = 'stthemeeditor';
		$helper->identifier = $this->identifier;
		$helper->token = Tools::getAdminTokenLite('AdminModules');
		foreach (Language::getLanguages(false) as $lang)
			$helper->languages[] = array(
				'id_lang' => $lang['id_lang'],
				'iso_code' => $lang['iso_code'],
				'name' => $lang['name'],
				'is_default' => ($default_lang == $lang['id_lang'] ? 1 : 0)
			);

		$helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;
		$helper->default_form_language = $default_lang;
		$helper->allow_employee_form_lang = $default_lang;
		$helper->toolbar_scroll = false;
		$helper->title = $this->displayName;
		$helper->submit_action = 'savestthemeeditor';
        
		$helper->toolbar_btn =  array(
			'save' => array(
				'desc' => $this->l('Save All'),
				'href' => AdminController::$currentIndex.'&configure='.$this->name.'&save'.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules'),
			),
			'delete' => array(
				'desc' => $this->l('Reset Change'),
                'force_desc' => true,
				'confirm' => 1,
				'js' => 'if (confirm(\''.$this->l('Reset all options, are you sure?').'\')){return true;}else{event.preventDefault();}',
				'href' => AdminController::$currentIndex.'&configure='.$this->name.'&reset'.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules'),
			),
			'green' => array(
				'desc' => $this->l('Import Green'),
                'force_desc' => true,
			    'class' => 'process-icon-new',
				'confirm' => 1,
				'js' => 'if (confirm(\''.$this->l('Importing Green color scheme, are your sure?').'\')){return true;}else{event.preventDefault();}',
				'href' => AdminController::$currentIndex.'&configure='.$this->name.'&predefinedcolor'.$this->name.'=green&token='.Tools::getAdminTokenLite('AdminModules'),
			),
			'gray' => array(
				'desc' => $this->l('Import Gray'),
                'force_desc' => true,
			    'class' => 'process-icon-new',
				'confirm' => 1,
				'js' => 'if (confirm(\''.$this->l('Importing Gray color scheme, are your sure?').'\')){return true;}else{event.preventDefault();}',
				'href' => AdminController::$currentIndex.'&configure='.$this->name.'&predefinedcolor'.$this->name.'=gray&token='.Tools::getAdminTokenLite('AdminModules'),
			),
			'red' => array(
				'desc' => $this->l('Import Red'),
                'force_desc' => true,
			    'class' => 'process-icon-new',
				'confirm' => 1,
				'js' => 'if (confirm(\''.$this->l('Importing Red color scheme, are your sure?').'\')){return true;}else{event.preventDefault();}',
				'href' => AdminController::$currentIndex.'&configure='.$this->name.'&predefinedcolor'.$this->name.'=red&token='.Tools::getAdminTokenLite('AdminModules'),
			),
			'blue' => array(
				'desc' => $this->l('Import Blue'),
                'force_desc' => true,
			    'class' => 'process-icon-new',
				'confirm' => 1,
				'js' => 'if (confirm(\''.$this->l('Importing Blue color scheme, are your sure?').'\')){return true;}else{event.preventDefault();}',
				'href' => AdminController::$currentIndex.'&configure='.$this->name.'&predefinedcolor'.$this->name.'=blue&token='.Tools::getAdminTokenLite('AdminModules'),
			),
			'brown' => array(
				'desc' => $this->l('Import Brown'),
                'force_desc' => true,
			    'class' => 'process-icon-new',
				'confirm' => 1,
				'js' => 'if (confirm(\''.$this->l('Importing Brown color scheme, are your sure?').'\')){return true;}else{event.preventDefault();}',
				'href' => AdminController::$currentIndex.'&configure='.$this->name.'&predefinedcolor'.$this->name.'=brown&token='.Tools::getAdminTokenLite('AdminModules'),
			),
		);
		return $helper;
	}
    
    public function fontOptions() {
        $system = $google = array();
        foreach($this->systemFonts as $v)
            $system[] = array('id'=>$v,'name'=>$v);
        foreach($this->googleFonts as $v)
            $google[] = array('id'=>$v,'name'=>$v);
        $module = new StThemeEditor();
        return array(
            array('name'=>$module->l('System Web fonts'),'query'=>$system),
            array('name'=>$module->l('Google Web Fonts'),'query'=>$google),
        );
	}
    public function getPatterns()
    {
        $html = '';
        foreach(range(1,9) as $v)
            $html .= '<div class="parttern_wrap"><span>'.$v.'</span><img src="'.$this->_path.'patterns/'.$v.'.png" /></div>';
        $html .= '<div>Pattern credits:<a href="http://subtlepatterns.com" target="_blank">subtlepatterns.com</a></div>';
        return $html;
    }
    public function getPatternsArray()
    {
        $arr = array();
        for($i=1;$i<=9;$i++)
            $arr[] = array('id'=>$i,'name'=>$i); 
        return $arr;   
    }
    private function _writeCss()
    {
        $id_shop = (int)Shop::getContextShopID();
        $css = '';
    	$fontText = Configuration::get('STSN_FONT_TEXT');
    	$fontHeading = Configuration::get('STSN_FONT_HEADING');
    	$fontPrice = Configuration::get('STSN_FONT_PRICE');
    	$fontMenu = Configuration::get('STSN_FONT_MENU');
    	$fontCartBtn = Configuration::get('STSN_FONT_CART_BTN');
    	        
        if($fontText)
    	   $css .='body{font:75%/150% '.$fontText.', Tahoma, sans-serif, Arial;}';
    	if($fontPrice != $fontText)
        	$css .='.price,#our_price_display,.old_price,.sale_percentage{font-family: "'.$fontPrice.'", Tahoma, sans-serif, Arial;}';
        if($fontCartBtn != $fontText)
            $css .='.list_view #product_list .ajax_add_to_cart_button,.btn_primary,.list_view #product_list .view_button,#buy_block .content_prices span.exclusive{font-family: "'.$fontCartBtn.'", Tahoma, sans-serif, Arial;}';
        $css_font_heading = 'font-weight: '.(Configuration::get('STSN_FONT_HEADING_WEIGHT') ? 'bold' : 'normal').';text-transform: '.self::$textTransform[(int)Configuration::get('STSN_FONT_HEADING_TRANS')]['name'].';'.($fontHeading != $fontText ? 'font-family: "'.$fontHeading.'";' : '');
        if(Configuration::get('STSN_FONT_HEADING_SIZE'))
            $css_font_heading .='font-size: '.(sprintf('%.3f',Configuration::get('STSN_FONT_HEADING_SIZE')/12)).'em;';            
            
        $css_font_menu = $css_font_mobile_menu = 'font-weight: '.(Configuration::get('STSN_FONT_MENU_WEIGHT') ? 'bold' : 'normal').';text-transform: '.self::$textTransform[(int)Configuration::get('STSN_FONT_MENU_TRANS')]['name'].';'.($fontMenu != $fontText ? 'font-family: "'.$fontMenu.'";' : '');
        if($fontMenu != $fontText)
        {
            $css_font_menu .= 'font-family: "'.$fontMenu.'";';
            $css_font_mobile_menu .= 'font-family: "'.$fontMenu.'";';
            $css .= '.style_wide .ma_level_1{font-family: "'.$fontMenu.'"}';
        }
        if(Configuration::get('STSN_FONT_MENU_SIZE'))
            $css_font_menu .='font-size: '.(sprintf('%.3f',Configuration::get('STSN_FONT_MENU_SIZE')/12)).'em;';
            
        $css .= '.block .title_block, .block a.title_block, .block .title_block a, .idTabs a,.product_accordion_title,.heading,#pc_slider_tabs a{'.$css_font_heading.'}';
        $css .= '#st_mega_menu .ma_level_0{'.$css_font_menu.'}'; 
        $css .= '#stmobilemenu .ma_level_0{'.$css_font_mobile_menu.'}'; 
        
        if(Configuration::get('STSN_FOOTER_HEADING_SIZE'))
            $css .='#footer .title_block{font-size: '.(sprintf('%.3f',Configuration::get('STSN_FOOTER_HEADING_SIZE')/12)).'em;}';
            
        if(Configuration::get('STSN_BLOCK_HEADINGS_COLOR'))
            $css .='.block .title_block, .block a.title_block, .block .title_block a{color: '.Configuration::get('STSN_BLOCK_HEADINGS_COLOR').';}';
        if(Configuration::get('STSN_HEADINGS_COLOR'))
            $css .='.heading, a.heading{color: '.Configuration::get('STSN_HEADINGS_COLOR').';}';
        if(Configuration::get('STSN_F_TOP_H_COLOR'))
            $css .='#footer-top .block .title_block, #footer-top .block a.title_block, #footer-top .block .title_block a{color: '.Configuration::get('STSN_F_TOP_H_COLOR').';}';
        if(Configuration::get('STSN_FOOTER_H_COLOR'))
            $css .='#footer-primary .block .title_block, #footer-primary .block a.title_block, #footer-primary .block .title_block a{color: '.Configuration::get('STSN_FOOTER_H_COLOR').';}';
        if(Configuration::get('STSN_F_SECONDARY_H_COLOR'))
            $css .='#footer-secondary .block .title_block, #footer-secondary .block a.title_block, #footer-secondary .block .title_block a{color: '.Configuration::get('STSN_F_SECONDARY_H_COLOR').';}';
            
        //color
        if(Configuration::get('STSN_TEXT_COLOR'))
            $css .='body{color: '.Configuration::get('STSN_TEXT_COLOR').';}';
        if(Configuration::get('STSN_LINK_COLOR'))
            $css .='a{color: '.Configuration::get('STSN_LINK_COLOR').';}';
        if(Configuration::get('STSN_LINK_HOVER_COLOR'))
            $css .='a:active,a:hover,
            #layered_block_left ul li a:hover,
            #product_comments_block_extra a:hover,
            .breadcrumb a:hover,
            a.color_666:hover,
            #pc_slider_tabs a.selected,
            #footer_info a:hover,
            .blog_info a:hover{color: '.Configuration::get('STSN_LINK_HOVER_COLOR').';}';
        if(Configuration::get('STSN_PRICE_COLOR'))
            $css .='.price,#our_price_display,.sale_percentage{color: '.Configuration::get('STSN_PRICE_COLOR').';}';
        if(Configuration::get('STSN_BREADCRUMB_COLOR'))
            $css .='.breadcrumb, .breadcrumb a{color: '.Configuration::get('STSN_BREADCRUMB_COLOR').';}';
        if(Configuration::get('STSN_BREADCRUMB_HOVER_COLOR'))
            $css .='.breadcrumb a:hover{color: '.Configuration::get('STSN_BREADCRUMB_HOVER_COLOR').';}';
        if($breadcrumb_bg_hex = Configuration::get('STSN_BREADCRUMB_BG'))
        {
            $breadcrumb_bg = self::hex2rgb($breadcrumb_bg_hex);
            if(is_array($breadcrumb_bg))
            {
                $breadcrumb_bg_star = ($breadcrumb_bg[0]-6).','.($breadcrumb_bg[1]-6).','.($breadcrumb_bg[2]-6);
                $breadcrumb_bg_end = implode(',',$breadcrumb_bg);
                $css .='#breadcrumb_wrapper{
background: '.$breadcrumb_bg_hex.';
background: -webkit-linear-gradient(top, rgb('.$breadcrumb_bg_star.') , rgb('.$breadcrumb_bg_end.') 10%, rgb('.$breadcrumb_bg_end.') 85%, rgb('.$breadcrumb_bg_star.'));
background: -moz-linear-gradient(top, rgb('.$breadcrumb_bg_star.'), rgb('.$breadcrumb_bg_end.') 10%, rgb('.$breadcrumb_bg_end.') 85%, rgb('.$breadcrumb_bg_star.'));
background: -o-linear-gradient(top, rgb('.$breadcrumb_bg_star.'), rgb('.$breadcrumb_bg_end.') 10%, rgb('.$breadcrumb_bg_end.') 85%, rgb('.$breadcrumb_bg_star.'));
background: linear-gradient(top, rgb('.$breadcrumb_bg_star.'), rgb('.$breadcrumb_bg_end.') 10%, rgb('.$breadcrumb_bg_end.') 85%, rgb('.$breadcrumb_bg_star.'));
                }';
            }
        }
        
        if(Configuration::get('STSN_ICON_COLOR'))
            $css .='a.icon_wrap, .icon_wrap,#shopping_cart .ajax_cart_right{color: '.Configuration::get('STSN_ICON_COLOR').';}';
        if(Configuration::get('STSN_ICON_HOVER_COLOR'))
            $css .='a.icon_wrap.active,.icon_wrap.active,a.icon_wrap:hover,.icon_wrap:hover,#searchbox_inner.active #submit_searchbox.icon_wrap,.logo_center #searchbox_inner:hover #submit_searchbox.icon_wrap,#shopping_cart:hover .icon_wrap,#shopping_cart.active .icon_wrap{color: '.Configuration::get('STSN_ICON_HOVER_COLOR').';}';
        if($icon_bg_color = Configuration::get('STSN_ICON_BG_COLOR'))
            $css .='a.icon_wrap, .icon_wrap,#shopping_cart .ajax_cart_right,#rightbar{background-color: '.$icon_bg_color.';}';    
        if($icon_hover_bg_color = Configuration::get('STSN_ICON_HOVER_BG_COLOR'))
        {
            $css .='a.icon_wrap.active,.icon_wrap.active,a.icon_wrap:hover,.icon_wrap:hover,#searchbox_inner.active #submit_searchbox.icon_wrap,.logo_center #searchbox_inner:hover #submit_searchbox.icon_wrap,#shopping_cart:hover .icon_wrap,#shopping_cart.active .icon_wrap{background-color: '.$icon_hover_bg_color.';}';    
            $css .='#submit_searchbox:hover,#searchbox_inner.active #search_query_top,#searchbox_inner.active #submit_searchbox.icon_wrap,.logo_center #searchbox_inner:hover #submit_searchbox.icon_wrap,.logo_center #shopping_cart.active,.logo_center #shopping_cart:hover{border-color:'.$icon_hover_bg_color.';}';      
        }
        if(Configuration::get('STSN_ICON_DISABLED_COLOR'))
            $css .='a.icon_wrap.disabled,.icon_wrap.disabled{color: '.Configuration::get('STSN_ICON_DISABLED_COLOR').';}';
        if(Configuration::get('STSN_RIGHT_PANEL_BORDER'))
            $css .='#rightbar,.rightbar_wrap a.icon_wrap,#to_top_wrap a.icon_wrap,#switch_left_column_wrap a.icon_wrap,#switch_right_column_wrap a.icon_wrap{border-color: '.Configuration::get('STSN_RIGHT_PANEL_BORDER').';}';
        if(Configuration::get('STSN_STARTS_COLOR'))
            $css .='.rating_box i.light{color: '.Configuration::get('STSN_STARTS_COLOR').';}';
        if(Configuration::get('STSN_CIRCLE_NUMBER_COLOR'))
            $css .='.amount_circle{color: '.Configuration::get('STSN_CIRCLE_NUMBER_COLOR').';}';
        if(Configuration::get('STSN_CIRCLE_NUMBER_BG'))
            $css .='.amount_circle{background-color: '.Configuration::get('STSN_CIRCLE_NUMBER_BG').';}';
            
        if($percent_of_screen = Configuration::get('STSN_POSITION_RIGHT_PANEL'))
        {
            $percent_of_screen_arr = explode('_',$percent_of_screen);
            $css .='#rightbar{top:'.($percent_of_screen_arr[0]==2 ? $percent_of_screen_arr[1].'%' : 'auto').'; bottom:'.($percent_of_screen_arr[0]==1 ? $percent_of_screen_arr[1].'%' : 'auto').';}';
        }
        //button  
        $button_css = $button_hover_css = $primary_button_css = $primary_button_hover_css = '';   
        if(Configuration::get('STSN_BTN_COLOR'))   
            $button_css .='color: '.Configuration::get('STSN_BTN_COLOR').';';
        if(Configuration::get('STSN_BTN_HOVER_COLOR'))   
            $button_hover_css .='color: '.Configuration::get('STSN_BTN_HOVER_COLOR').';';
        if(Configuration::get('STSN_BTN_BG_COLOR'))   
            $button_css .='background-color: '.Configuration::get('STSN_BTN_BG_COLOR').';border-color:'.Configuration::get('STSN_BTN_BG_COLOR').';';
        if(Configuration::get('STSN_BTN_HOVER_BG_COLOR'))   
            $button_hover_css .='background-color: '.Configuration::get('STSN_BTN_HOVER_BG_COLOR').';border-color:'.Configuration::get('STSN_BTN_HOVER_BG_COLOR').';';
        if(Configuration::get('STSN_P_BTN_COLOR'))   
        {
            $primary_button_css .='color: '.Configuration::get('STSN_P_BTN_COLOR').';';
            $css .= '.hover_fly a,.hover_fly a:hover,.hover_fly a:first-child,.hover_fly a:first-child:hover{color:'.Configuration::get('STSN_P_BTN_COLOR').'!important;}';
        }
        if(Configuration::get('STSN_P_BTN_HOVER_COLOR'))   
            $primary_button_hover_css .='color: '.Configuration::get('STSN_P_BTN_HOVER_COLOR').';';
        if(Configuration::get('STSN_P_BTN_BG_COLOR'))   
        {
            $primary_button_css .='background-color: '.Configuration::get('STSN_P_BTN_BG_COLOR').';border-color:'.Configuration::get('STSN_P_BTN_BG_COLOR').';';
            $css .= '.hover_fly a:first-child{background-color: '.Configuration::get('STSN_P_BTN_BG_COLOR').';}.itemlist_action a{background-color: '.Configuration::get('STSN_P_BTN_BG_COLOR').';}.hover_fly a:hover{background-color: '.Configuration::get('STSN_P_BTN_BG_COLOR').'!important;}.itemlist_action a:hover{background-color: '.Configuration::get('STSN_P_BTN_BG_COLOR').';}';
        }
        if(Configuration::get('STSN_P_BTN_HOVER_BG_COLOR'))   ;
            $primary_button_hover_css .='background-color: '.Configuration::get('STSN_P_BTN_HOVER_BG_COLOR').';border-color:'.Configuration::get('STSN_P_BTN_HOVER_BG_COLOR').';';
            
        if($button_css)
            $css .= 'input.button_mini, input.button_small, input.button, input.button_large,
input.button_mini_disabled, input.button_small_disabled, input.button_disabled, input.button_large_disabled,
input.exclusive_mini, input.exclusive_small, input.exclusive, input.exclusive_large,
input.exclusive_mini_disabled, input.exclusive_small_disabled, input.exclusive_disabled, input.exclusive_large_disabled,
a.button_mini, a.button_small, a.button, a.button_large,
a.exclusive_mini, a.exclusive_small, a.exclusive, a.exclusive_large,
span.button_mini, span.button_small, span.button, span.button_large,
span.exclusive_mini, span.exclusive_small, span.exclusive, span.exclusive_large, span.exclusive_large_disabled{'.$button_css.'}';
        if($button_hover_css)
            $css .= 'input.button_mini:hover, input.button_small:hover, input.button:hover, input.button_large:hover,
input.exclusive_mini:hover, input.exclusive_small:hover, input.exclusive:hover, input.exclusive_large:hover,
a.button_mini:hover, a.button_small:hover, a.button:hover, a.button_large:hover,
a.exclusive_mini:hover, a.exclusive_small:hover, a.exclusive:hover, a.exclusive_large:hover{'.$button_hover_css.'}';
        if($primary_button_css)
            $css .= '.list_view #product_list .ajax_add_to_cart_button,
input.button_mini.btn_primary, input.button_small.btn_primary, input.button.btn_primary, input.button_large.btn_primary,
input.exclusive_mini.btn_primary, input.exclusive_small.btn_primary, input.exclusive.btn_primary, input.exclusive_large.btn_primary,
a.button_mini.btn_primary, a.button_small.btn_primary, a.button.btn_primary, a.button_large.btn_primary,
a.exclusive_mini.btn_primary, a.exclusive_small.btn_primary, a.exclusive.btn_primary, a.exclusive_large.btn_primary,.itemlist_action a.exclusive {'.$primary_button_css.'}';
        if($primary_button_hover_css)
            $css .= '.list_view #product_list .ajax_add_to_cart_button:hover,
input.button_mini.btn_primary:hover, input.button_small.btn_primary:hover, input.button.btn_primary:hover, input.button_large.btn_primary:hover,
input.exclusive_mini.btn_primary:hover, input.exclusive_small.btn_primary:hover, input.exclusive.btn_primary:hover, input.exclusive_large.btn_primary:hover,
a.button_mini.btn_primary:hover, a.button_small.btn_primary:hover, a.button.btn_primary:hover, a.button_large.btn_primary:hover,
a.exclusive_mini.btn_primary:hover, a.exclusive_small.btn_primary:hover, a.exclusive.btn_primary:hover, a.exclusive_large.btn_primary:hover,.itemlist_action a.exclusive:hover{'.$primary_button_hover_css.'}';
           
        //header
        if(Configuration::get('STSN_HEADER_TEXT_COLOR'))
            $css .='#top_bar{color:'.Configuration::get('STSN_HEADER_TEXT_COLOR').';}';
        if(Configuration::get('STSN_HEADER_LINK_COLOR'))
            $css .='#top_bar a{color:'.Configuration::get('STSN_HEADER_LINK_COLOR').';}.dropdown_tri_inner b{border-color: '.Configuration::get('STSN_HEADER_LINK_COLOR').' transparent transparent;}';
        if(Configuration::get('STSN_HEADER_LINK_HOVER_COLOR'))
            $css .='#top_bar a:hover,#top_bar .open .dropdown_tri_inner{color:'.Configuration::get('STSN_HEADER_LINK_HOVER_COLOR').';}.open .dropdown_tri_inner b{border-color: '.Configuration::get('STSN_HEADER_LINK_HOVER_COLOR').' transparent transparent;}';
        if(Configuration::get('STSN_HEADER_LINK_HOVER_BG'))
            $css .='#top_bar a:hover,#top_bar .open .dropdown_tri_inner{background-color:'.Configuration::get('STSN_HEADER_LINK_HOVER_BG').';}';
        if(Configuration::get('STSN_DROPDOWN_HOVER_COLOR'))
            $css .='#top_bar .dropdown_list li a:hover{color:'.Configuration::get('STSN_DROPDOWN_HOVER_COLOR').';}';   
        if(Configuration::get('STSN_DROPDOWN_BG_COLOR'))
            $css .='#top_bar .dropdown_list li a:hover{background-color:'.Configuration::get('STSN_DROPDOWN_BG_COLOR').';}'; 
        if(Configuration::get('STSN_HEADER_TOPBAR_BG'))
            $css .='#top_bar{background-color:'.Configuration::get('STSN_HEADER_TOPBAR_BG').';}'; 
        if(Configuration::get('STSN_HEADER_TOPBAR_SEP'))
            $css .='#top_bar #header_user_info a,#top_bar #header_user_info span,.dropdown_tri_inner{border-color:'.Configuration::get('STSN_HEADER_TOPBAR_SEP').';}'; 
                    
        //menu
        if(Configuration::get('STSN_MENU_COLOR'))
            $css .='.ma_level_0{color:'.Configuration::get('STSN_MENU_COLOR').';}'; 
        if(Configuration::get('STSN_MENU_HOVER_COLOR'))
            $css .='.sttlevel0.current .ma_level_0, .sttlevel0.active .ma_level_0{color:'.Configuration::get('STSN_MENU_HOVER_COLOR').';}'; 
        if(Configuration::get('STSN_MENU_HOVER_BG'))
            $css .='.sttlevel0.current .ma_level_0, .sttlevel0.active .ma_level_0{background-color:'.Configuration::get('STSN_MENU_HOVER_BG').';}'; 
        if(Configuration::get('STSN_MENU_BG_COLOR'))
            $css .='#st_mega_menu_wrap{background-color:'.Configuration::get('STSN_MENU_BG_COLOR').';}'; 
        if(Configuration::get('STSN_SECOND_MENU_COLOR'))
            $css .='.ma_level_1,.stmenu_sub.style_classic .ma_level_1{color:'.Configuration::get('STSN_SECOND_MENU_COLOR').';}'; 
        if(Configuration::get('STSN_SECOND_MENU_HOVER_COLOR'))
            $css .='.ma_level_1:hover,.stmenu_sub.style_classic .show .ma_level_1{color:'.Configuration::get('STSN_SECOND_MENU_HOVER_COLOR').';}'; 
        if(Configuration::get('STSN_THIRD_MENU_COLOR'))
            $css .='.ma_level_2{color:'.Configuration::get('STSN_THIRD_MENU_COLOR').';}'; 
        if(Configuration::get('STSN_THIRD_MENU_HOVER_COLOR'))
            $css .='.ma_level_2:hover{color:'.Configuration::get('STSN_THIRD_MENU_HOVER_COLOR').';}'; 
        if(Configuration::get('STSN_MENU_MOB_COLOR'))
            $css .='#stmobilemenu_tri{color:'.Configuration::get('STSN_MENU_MOB_COLOR').';}'; 
        if(Configuration::get('STSN_MENU_MOB_HOVER_COLOR'))
            $css .='#stmobilemenu_tri:hover,#stmobilemenu_tri.active{color:'.Configuration::get('STSN_MENU_MOB_HOVER_COLOR').';}'; 
        if(Configuration::get('STSN_MENU_MOB_BG'))
            $css .='#stmobilemenu_tri{background-color:'.Configuration::get('STSN_MENU_MOB_BG').';}'; 
        if(Configuration::get('STSN_MENU_MOB_HOVER_BG'))
            $css .='#stmobilemenu_tri:hover,#stmobilemenu_tri.active{background-color:'.Configuration::get('STSN_MENU_MOB_HOVER_BG').';}';
        if(Configuration::get('STSN_MENU_MOB_ITEMS1_COLOR'))
            $css .='#stmobilemenu .ma_level_0,#stmobilemenu a.ma_level_0{color:'.Configuration::get('STSN_MENU_MOB_ITEMS1_COLOR').';}';
        if(Configuration::get('STSN_MENU_MOB_ITEMS2_COLOR'))
            $css .='#stmobilemenu .ma_level_1,#stmobilemenu a.ma_level_1{color:'.Configuration::get('STSN_MENU_MOB_ITEMS2_COLOR').';}';
        if(Configuration::get('STSN_MENU_MOB_ITEMS3_COLOR'))
            $css .='#stmobilemenu .ma_level_2,#stmobilemenu a.ma_level_2{color:'.Configuration::get('STSN_MENU_MOB_ITEMS3_COLOR').';}';
        if(Configuration::get('STSN_MENU_MOB_ITEMS1_BG'))
            $css .='#stmobilemenu .stmlevel0{background-color:'.Configuration::get('STSN_MENU_MOB_ITEMS1_BG').';}';
        if(Configuration::get('STSN_MENU_MOB_ITEMS2_BG'))
            $css .='#stmobilemenu .stmlevel1 > li{background-color:'.Configuration::get('STSN_MENU_MOB_ITEMS2_BG').';}';
        if(Configuration::get('STSN_MENU_MOB_ITEMS3_BG'))
            $css .='#stmobilemenu .stmlevel2 > li{background-color:'.Configuration::get('STSN_MENU_MOB_ITEMS3_BG').';}';
        //footer
        if(Configuration::get('STSN_FOOTER_BORDER_COLOR'))
            $css .='#footer-primary .container{border-color:'.Configuration::get('STSN_FOOTER_BORDER_COLOR').';}';
        if(Configuration::get('STSN_SECOND_FOOTER_COLOR')) 
            $css .='#footer_info,#footer_info a{color:'.Configuration::get('STSN_SECOND_FOOTER_COLOR').';}';   
        if(Configuration::get('STSN_FOOTER_COLOR')) 
            $css .='#footer{color:'.Configuration::get('STSN_FOOTER_COLOR').';}'; 
        if(Configuration::get('STSN_FOOTER_LINK_COLOR')) 
            $css .='#footer a{color:'.Configuration::get('STSN_FOOTER_LINK_COLOR').';}'; 
        if(Configuration::get('STSN_FOOTER_LINK_HOVER_COLOR')) 
            $css .='#footer a:hover{color:'.Configuration::get('STSN_FOOTER_LINK_HOVER_COLOR').';}';    
        
        
        if (Configuration::get('STSN_BODY_BG_COLOR'))
			$css .= 'body{background-color:'.Configuration::get('STSN_BODY_BG_COLOR').';}';
        if (Configuration::get('STSN_BODY_BG_PATTERN') && (Configuration::get('STSN_BODY_BG_IMG')==""))
			$css .= 'body{background-image: url(../../patterns/'.Configuration::get('STSN_BODY_BG_PATTERN').'.png);}';
        if (Configuration::get('STSN_BODY_BG_IMG'))
			$css .= 'body{background-image:url(../../'.Configuration::get('STSN_BODY_BG_IMG').');}';
		if (Configuration::get('STSN_BODY_BG_REPEAT')) {
			switch(Configuration::get('STSN_BODY_BG_REPEAT')) {
				case 1 :
					$repeat_option = 'repeat-x';
					break;
				case 2 :
					$repeat_option = 'repeat-y';
					break;
				case 3 :
					$repeat_option = 'no-repeat';
					break;
				default :
					$repeat_option = 'repeat';
			}
			$css .= 'body{background-repeat:'.$repeat_option.';}';
		}
		if (Configuration::get('STSN_BODY_BG_POSITION')) {
			switch(Configuration::get('STSN_BODY_BG_POSITION')) {
				case 1 :
					$position_option = 'center top';
					break;
				case 2 :
					$position_option = 'right top';
					break;
				default :
					$position_option = 'left top';
			}
			$css .= 'body{background-position: '.$position_option.';}';
		}
		if (Configuration::get('STSN_BODY_BG_FIXED')) {
			$css .= 'body{background-attachment: fixed;}';
		}
        if (Configuration::get('STSN_HEADER_BG_COLOR'))
			$css .= '#page_header{background-color:'.Configuration::get('STSN_HEADER_BG_COLOR').';}';
        if (Configuration::get('STSN_HEADER_CON_BG_COLOR'))
			$css .= '#header .wide_container,#top_extra .wide_container{background-color:'.Configuration::get('STSN_HEADER_CON_BG_COLOR').';}';
        if (Configuration::get('STSN_HEADER_BG_PATTERN') && (Configuration::get('STSN_HEADER_BG_IMG')==""))
			$css .= '#page_header{background-image: url(../../patterns/'.Configuration::get('STSN_HEADER_BG_PATTERN').'.png);}';
        if (Configuration::get('STSN_HEADER_BG_IMG'))
			$css .= '#page_header{background-image:url(../../'.Configuration::get('STSN_HEADER_BG_IMG').');}';
		if (Configuration::get('STSN_HEADER_BG_REPEAT')) {
			switch(Configuration::get('STSN_HEADER_BG_REPEAT')) {
				case 1 :
					$repeat_option = 'repeat-x';
					break;
				case 2 :
					$repeat_option = 'repeat-y';
					break;
				case 3 :
					$repeat_option = 'no-repeat';
					break;
				default :
					$repeat_option = 'repeat';
			}
			$css .= '#page_header{background-repeat:'.$repeat_option.';}';
		}
		if (Configuration::get('STSN_HEADER_BG_POSITION')) {
			switch(Configuration::get('STSN_HEADER_BG_POSITION')) {
				case 1 :
					$position_option = 'center top';
					break;
				case 2 :
					$position_option = 'right top';
					break;
				default :
					$position_option = 'left top';
			}
			$css .= '#page_header{background-position: '.$position_option.';}';
		}
                            
        if (Configuration::get('STSN_F_TOP_BG_PATTERN') && (Configuration::get('STSN_F_TOP_BG_IMG')==""))
			$css .= '#footer-top{background-image: url(../../patterns/'.Configuration::get('STSN_F_TOP_BG_PATTERN').'.png);}';
        if (Configuration::get('STSN_F_TOP_BG_IMG'))
			$css .= '#footer-top{background-image:url(../../'.Configuration::get('STSN_F_TOP_BG_IMG').');}';
		if (Configuration::get('STSN_FOOTER_BG_REPEAT')) {
			switch(Configuration::get('STSN_FOOTER_BG_REPEAT')) {
				case 1 :
					$repeat_option = 'repeat-x';
					break;
				case 2 :
					$repeat_option = 'repeat-y';
					break;
				case 3 :
					$repeat_option = 'no-repeat';
					break;
				default :
					$repeat_option = 'repeat';
			}
			$css .= '#footer-top{background-repeat:'.$repeat_option.';}';
		}
		if (Configuration::get('STSN_F_TOP_BG_PATTERN')) {
			switch(Configuration::get('STSN_F_TOP_BG_PATTERN')) {
				case 1 :
					$position_option = 'center top';
					break;
				case 2 :
					$position_option = 'right top';
					break;
				default :
					$position_option = 'left top';
			}
			$css .= '#footer-top{background-position: '.$position_option.';}';
		}
        if (Configuration::get('STSN_FOOTER_TOP_BORDER_COLOR'))
			$css .= '#footer-top{border-top-color:'.Configuration::get('STSN_FOOTER_TOP_BORDER_COLOR').';}';
        if (Configuration::get('STSN_FOOTER_TOP_BG'))
			$css .= '#footer-top{background-color:'.Configuration::get('STSN_FOOTER_TOP_BG').';}';
        if (Configuration::get('STSN_FOOTER_TOP_CON_BG'))
			$css .= '#footer-top .wide_container{background-color:'.Configuration::get('STSN_FOOTER_TOP_CON_BG').';}';
            
        if (Configuration::get('STSN_FOOTER_BG_PATTERN') && (Configuration::get('STSN_FOOTER_BG_IMG')==""))
			$css .= '#footer-primary{background-image: url(../../patterns/'.Configuration::get('STSN_FOOTER_BG_PATTERN').'.png);}';
        if (Configuration::get('STSN_FOOTER_BG_IMG'))
			$css .= '#footer-primary{background-image:url(../../'.Configuration::get('STSN_FOOTER_BG_IMG').');}';
		if (Configuration::get('STSN_FOOTER_BG_REPEAT')) {
			switch(Configuration::get('STSN_FOOTER_BG_REPEAT')) {
				case 1 :
					$repeat_option = 'repeat-x';
					break;
				case 2 :
					$repeat_option = 'repeat-y';
					break;
				case 3 :
					$repeat_option = 'no-repeat';
					break;
				default :
					$repeat_option = 'repeat';
			}
			$css .= '#footer-primary{background-repeat:'.$repeat_option.';}';
		}
		if (Configuration::get('STSN_FOOTER_BG_POSITION')) {
			switch(Configuration::get('STSN_FOOTER_BG_POSITION')) {
				case 1 :
					$position_option = 'center top';
					break;
				case 2 :
					$position_option = 'right top';
					break;
				default :
					$position_option = 'left top';
			}
			$css .= '#footer-primary{background-position: '.$position_option.';}';
		}
        if (Configuration::get('STSN_FOOTER_BG_COLOR'))
			$css .= '#footer-primary{background-color:'.Configuration::get('STSN_FOOTER_BG_COLOR').';}';
        if (Configuration::get('STSN_FOOTER_CON_BG_COLOR'))
			$css .= '#footer-primary .wide_container{background-color:'.Configuration::get('STSN_FOOTER_CON_BG_COLOR').';}';
            
        if (Configuration::get('STSN_F_SECONDARY_BG_PATTERN') && (Configuration::get('STSN_F_SECONDARY_BG_IMG')==""))
			$css .= '#footer-secondary{background-image: url(../../patterns/'.Configuration::get('STSN_F_SECONDARY_BG_PATTERN').'.png);}';
        if (Configuration::get('STSN_F_SECONDARY_BG_IMG'))
			$css .= '#footer-secondary{background-image:url(../../'.Configuration::get('STSN_F_SECONDARY_BG_IMG').');}';
		if (Configuration::get('STSN_F_SECONDARY_BG_REPEAT')) {
			switch(Configuration::get('STSN_F_SECONDARY_BG_REPEAT')) {
				case 1 :
					$repeat_option = 'repeat-x';
					break;
				case 2 :
					$repeat_option = 'repeat-y';
					break;
				case 3 :
					$repeat_option = 'no-repeat';
					break;
				default :
					$repeat_option = 'repeat';
			}
			$css .= '#footer-secondary{background-repeat:'.$repeat_option.';}';
		}
		if (Configuration::get('STSN_F_SECONDARY_BG_POSITION')) {
			switch(Configuration::get('STSN_F_SECONDARY_BG_POSITION')) {
				case 1 :
					$position_option = 'center top';
					break;
				case 2 :
					$position_option = 'right top';
					break;
				default :
					$position_option = 'left top';
			}
			$css .= '#footer-secondary{background-position: '.$position_option.';}';
		}
        if (Configuration::get('STSN_FOOTER_SECONDARY_BG'))
			$css .= '#footer-secondary{background-color:'.Configuration::get('STSN_FOOTER_SECONDARY_BG').';}';
        if (Configuration::get('STSN_FOOTER_SECONDARY_CON_BG'))
			$css .= '#footer-secondary .wide_container{background-color:'.Configuration::get('STSN_FOOTER_SECONDARY_CON_BG').';}';
            
                        
        if (Configuration::get('STSN_F_INFO_BG_PATTERN') && (Configuration::get('STSN_F_INFO_BG_IMG')==""))
			$css .= '#footer_info{background-image: url(../../patterns/'.Configuration::get('STSN_F_INFO_BG_PATTERN').'.png);}';
        if (Configuration::get('STSN_F_INFO_BG_IMG'))
			$css .= '#footer_info{background-image:url(../../'.Configuration::get('STSN_F_INFO_BG_IMG').');}';
		if (Configuration::get('STSN_F_INFO_BG_REPEAT')) {
			switch(Configuration::get('STSN_F_INFO_BG_REPEAT')) {
				case 1 :
					$repeat_option = 'repeat-x';
					break;
				case 2 :
					$repeat_option = 'repeat-y';
					break;
				case 3 :
					$repeat_option = 'no-repeat';
					break;
				default :
					$repeat_option = 'repeat';
			}
			$css .= '#footer_info{background-repeat:'.$repeat_option.';}';
		}
		if (Configuration::get('STSN_F_INFO_BG_POSITION')) {
			switch(Configuration::get('STSN_F_INFO_BG_POSITION')) {
				case 1 :
					$position_option = 'center top';
					break;
				case 2 :
					$position_option = 'right top';
					break;
				default :
					$position_option = 'left top';
			}
			$css .= '#footer_info{background-position: '.$position_option.';}';
		}
        if (Configuration::get('STSN_FOOTER_INFO_BG'))
			$css .= '#footer_info{background-color:'.Configuration::get('STSN_FOOTER_INFO_BG').';}';
        if (Configuration::get('STSN_FOOTER_INFO_CON_BG'))
			$css .= '#footer_info .wide_container{background-color:'.Configuration::get('STSN_FOOTER_INFO_CON_BG').';}';
        
        if(!Configuration::get('STSN_RESPONSIVE'))    
			$css .= '#body_wrapper{min-width:960px;margin-right:auto;margin-left:auto;}';
        
        if(Configuration::get('STSN_NEW_COLOR'))
            $css .='span.new i{color: '.Configuration::get('STSN_NEW_COLOR').';}';
        $new_style = (int)Configuration::get('STSN_NEW_STYLE');
		if($new_style==1)
        {
            $css .= 'span.new{border:none;width:40px;height:40px;line-height:40px;top:0;-webkit-border-radius: 500px;-moz-border-radius: 500px;border-radius: 500px;}span.new i{position:static;left:auto;}';
            if(!Configuration::get('STSN_NEW_BG_IMG'))
                $css .= 'span.new{-webkit-border-radius: 500px;-moz-border-radius: 500px;border-radius: 500px;}';
        }                    
        $new_bg_color = Configuration::get('STSN_NEW_BG_COLOR');
        if($new_bg_color)
        {
            if($new_style==1)
                $css .= 'span.new{background-color:'.$new_bg_color.';}';
            $css .='span.new{color: '.$new_bg_color.';border-color:'.$new_bg_color.';border-left-color:transparent;}';
        }  
        elseif(!$new_bg_color && $new_style==1) 
            $css .= 'span.new{background-color:#00A161;}';
        
        if($new_stickers_width = Configuration::get('STSN_NEW_STICKERS_WIDTH'))
        {
            if($new_style==1)
                $css .= 'span.new{width:'.$new_stickers_width.'px;height:'.$new_stickers_width.'px;line-height:'.$new_stickers_width.'px;}';
            else
                $css .= 'span.new{border-right-width:'.$new_stickers_width.'px;}';
        }
		if(Configuration::get('STSN_NEW_STICKERS_TOP')!==false)
			$css .= 'span.new{top:'.(int)Configuration::get('STSN_NEW_STICKERS_TOP').'px;}';
		if(Configuration::get('STSN_NEW_STICKERS_RIGHT')!==false)
			$css .= 'span.new{right:'.(int)Configuration::get('STSN_NEW_STICKERS_RIGHT').'px;}';
		if($new_style==1 && Configuration::get('STSN_NEW_BG_IMG'))
			$css .= 'span.new{background:url(../../'.Configuration::get('STSN_NEW_BG_IMG').') no-repeat center center transparent;}span.new i{display:none;}';
            
        if(Configuration::get('STSN_SALE_COLOR'))
            $css .='span.on_sale i{color: '.Configuration::get('STSN_SALE_COLOR').';}';
        $sale_style = (int)Configuration::get('STSN_SALE_STYLE');
        if($sale_style==1)  
        {
            $css .= 'span.on_sale{border:none;width:40px;height:40px;line-height:40px;top:0;-webkit-border-radius: 500px;-moz-border-radius: 500px;border-radius: 500px;}span.on_sale i{position:static;left:auto;}';
            if(!Configuration::get('STSN_SALE_BG_IMG'))
                $css .= 'span.on_sale{-webkit-border-radius: 500px;-moz-border-radius: 500px;border-radius: 500px;}';
        }       
        $sale_bg_color = Configuration::get('STSN_SALE_BG_COLOR');
        if($sale_bg_color)
        {
            if($sale_style==1)
                $css .= 'span.on_sale{background-color:'.$sale_bg_color.';}';
            $css .='span.on_sale{color: '.$sale_bg_color.';border-color: '.$sale_bg_color.';border-right-color:transparent;}';
        }
        elseif(!$sale_bg_color && $sale_style==1)
            $css .= 'span.on_sale{background-color:#ff8a00;}';        

		if($sale_stickers_width = Configuration::get('STSN_SALE_STICKERS_WIDTH'))
        {
            if($sale_style==1)
                $css .= 'span.on_sale{width:'.$sale_stickers_width.'px;height:'.$sale_stickers_width.'px;line-height:'.$sale_stickers_width.'px;}';
            else
            {
    			$css .= 'span.on_sale{border-left-width:'.$sale_stickers_width.'px;}';
    			$css .= 'span.on_sale i{left:-'.($sale_stickers_width-7).'px;}';
            }
        }
		if(Configuration::get('STSN_SALE_STICKERS_TOP')!==false)
			$css .= 'span.on_sale{top:'.(int)Configuration::get('STSN_SALE_STICKERS_TOP').'px;}';
		if(Configuration::get('STSN_SALE_STICKERS_LEFT')!==false)
			$css .= 'span.on_sale{left:'.(int)Configuration::get('STSN_SALE_STICKERS_LEFT').'px;}';
		if($sale_style==1 && Configuration::get('STSN_SALE_BG_IMG'))
			$css .= 'span.on_sale{background:url(../../'.Configuration::get('STSN_SALE_BG_IMG').') no-repeat center center transparent;}span.on_sale i{display:none;}';
             
        if(Configuration::get('STSN_PRICE_DROP_COLOR'))
    	    $css .= 'span.sale_percentage_sticker{color: '.Configuration::get('STSN_PRICE_DROP_COLOR').';}';
        if(Configuration::get('STSN_PRICE_DROP_BORDER_COLOR'))
    	    $css .= 'span.sale_percentage_sticker{border-color: '.Configuration::get('STSN_PRICE_DROP_BORDER_COLOR').';}';
        if(Configuration::get('STSN_PRICE_DROP_BG_COLOR'))
    	    $css .= 'span.sale_percentage_sticker{background-color: '.Configuration::get('STSN_PRICE_DROP_BG_COLOR').';}';
        if(Configuration::get('STSN_PRICE_DROP_BOTTOM')!==false)
    	    $css .= 'span.sale_percentage_sticker{bottom: '.(int)Configuration::get('STSN_PRICE_DROP_BOTTOM').'px;}';
        if(Configuration::get('STSN_PRICE_DROP_RIGHT')!==false)
    	    $css .= 'span.sale_percentage_sticker{right: '.(int)Configuration::get('STSN_PRICE_DROP_RIGHT').'px;}';
        $price_drop_width = (int)Configuration::get('STSN_PRICE_DROP_WIDTH');
        if($price_drop_width>28)
        {
            $price_drop_padding = round(($price_drop_width-28)/2,3);
    	    $css .= 'span.sale_percentage_sticker{width: '.$price_drop_width.'px;padding:'.$price_drop_padding.'px 0;}';            
        }
        if(Configuration::get('STSN_LOGO_POSITION') && Configuration::get('STSN_LOGO_HEIGHT'))
    	    $css .= '.logo_center #header_left,.logo_center #logo_wrapper,.logo_center #header_right{height: '.(int)Configuration::get('STSN_LOGO_HEIGHT').'px;}';   
        if($megamenu_position = Configuration::get('STSN_MEGAMENU_POSITION'))
    	    $css .= '#st_mega_menu{text-align: '.($megamenu_position==1 ? 'center' : 'right').';}.sttlevel0{float:none;display:inline-block;}';   
            
        if(Configuration::get('STSN_CART_ICON'))
            $css .= '.icon-basket:before{ content: "\e83c"; }';
        if(Configuration::get('STSN_WISHLIST_ICON'))
            $css .= '.icon-heart:before{ content: "\e800"; }';
        if(Configuration::get('STSN_COMPARE_ICON'))
            $css .= '.icon-ajust:before{ content: "\e808"; }';
            
        if(Configuration::get('STSN_PRO_TAB_COLOR'))  
            $css .= '#more_info_tabs a{ color: '.Configuration::get('STSN_PRO_TAB_COLOR').'; }';
        if(Configuration::get('STSN_PRO_TAB_ACTIVE_COLOR'))  
            $css .= '#more_info_tabs a.selected,#more_info_tabs a:hover{ color: '.Configuration::get('STSN_PRO_TAB_ACTIVE_COLOR').'; }';
        if(Configuration::get('STSN_PRO_TAB_BG'))  
            $css .= '#more_info_tabs a{ background-color: '.Configuration::get('STSN_PRO_TAB_BG').'; }';
        if(Configuration::get('STSN_PRO_TAB_ACTIVE_BG'))  
            $css .= '#more_info_tabs a.selected{ background-color: '.Configuration::get('STSN_PRO_TAB_ACTIVE_BG').'; }';
        if(Configuration::get('STSN_PRO_TAB_CONTENT_BG'))  
            $css .= '#more_info_sheets{ background-color: '.Configuration::get('STSN_PRO_TAB_CONTENT_BG').'; }';
        
        if (Configuration::get('STSN_CUSTOM_CSS') != "")
			$css .= Configuration::get('STSN_CUSTOM_CSS');
            
        if (Shop::getContext() == Shop::CONTEXT_GROUP)
            $cssFile = $this->local_path."views/css/customer-g".(int)$this->context->shop->getContextShopGroupID().".css";
        elseif (Shop::getContext() == Shop::CONTEXT_SHOP)
            $cssFile = $this->local_path."views/css/customer-s".(int)$this->context->shop->getContextShopID().".css";
    
		$write_fd = fopen($cssFile, 'w') or die('can\'t open file "'.$cssFile.'"');
		fwrite($write_fd, $css);
		fclose($write_fd);
        
        if (Configuration::get('STSN_CUSTOM_JS') != "")
		{
		    $jsFile = $this->local_path."views/js/customer".$id_shop.".js";
    		$write_fd = fopen($jsFile, 'w') or die('can\'t open file "'.$jsFile.'"');
    		fwrite($write_fd, Configuration::get('STSN_CUSTOM_JS'));
    		fclose($write_fd);
		}
        else
            if(file_exists($this->local_path.'views/js/customer'.$id_shop.'.js'))
                unlink($this->local_path.'views/js/customer'.$id_shop.'.js');
    }
    
    public static function hex2rgb($hex) {
       $hex = str_replace("#", "", $hex);
    
       if(strlen($hex) == 3) {
          $r = hexdec(substr($hex,0,1).substr($hex,0,1));
          $g = hexdec(substr($hex,1,1).substr($hex,1,1));
          $b = hexdec(substr($hex,2,1).substr($hex,2,1));
       } else {
          $r = hexdec(substr($hex,0,2));
          $g = hexdec(substr($hex,2,2));
          $b = hexdec(substr($hex,4,2));
       }
       $rgb = array($r, $g, $b);
       return $rgb;
    }
    
	public function hookActionShopDataDuplication($params)
	{
	    $this->_useDefault(false,shop::getGroupFromShop($params['new_id_shop']),$params['new_id_shop']);
	}
    function hookDisplayAdminHomeQuickLinks() {
			echo '<li id="stthemeeditor_block">
			<a  style="background:url('.$this->_path.'logo.png) no-repeat center 25px #F8F8F8;" href="index.php?controller=AdminModules&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'">
				<h4>Theme Editor Module</h4>
				<p>Customize your theme</p>
			</a>
    		</li>';
    }
    public function hookHeader($params)
	{
        $id_shop = (int)Shop::getContextShopID();
        $googleFontLinks = '';
	    $theme_font = array();
    	$theme_font[] = Configuration::get('STSN_FONT_TEXT');
        $theme_font[] = Configuration::get('STSN_FONT_HEADING');
        $theme_font[] = Configuration::get('STSN_FONT_PRICE');
        $theme_font[] = Configuration::get('STSN_FONT_MENU');
    	$theme_font[] = Configuration::get('STSN_FONT_CART_BTN');
    	$theme_font[] = Configuration::get('STSN_FONT_TITLE');
        
        $theme_font = array_unique($theme_font);
        $fonts = $this->systemFonts;
        $theme_font = array_diff($theme_font,$fonts);
        
        $font_latin_support = Configuration::get('STSN_FONT_LATIN_SUPPORT');
        $font_cyrillic_support = Configuration::get('STSN_FONT_CYRILLIC_SUPPORT');
        $font_vietnamese = Configuration::get('STSN_FONT_VIETNAMESE');
        $font_greek_support = Configuration::get('STSN_FONT_GREEK_SUPPORT');
        $font_support = ($font_latin_support || $font_cyrillic_support || $font_vietnamese || $font_greek_support) ? '&subset=' : '';
        $font_latin_support && $font_support .= 'latin,latin-ext,';
        $font_cyrillic_support && $font_support .= 'cyrillic,cyrillic-ext,';
        $font_vietnamese && $font_support .= 'vietnamese,';
        $font_greek_support && $font_support .= 'greek,greek-ext,';
        if(is_array($theme_font) && count($theme_font))
            foreach($theme_font as $v)
            {
                if(!$v)
                    continue;
    	        $googleFontLinks .="<link href='//fonts.googleapis.com/css?family=".str_replace(' ', '+', $v).($font_support ? rtrim($font_support,',') : '')."' rel='stylesheet' type='text/css'>";
            }
	    $footer_img_src = '';
	    if(Configuration::get('STSN_FOOTER_IMG') !='' )
	       $footer_img_src = (Configuration::get('STSN_FOOTER_IMG')==$this->defaults["footer_img"] ? _MODULE_DIR_.$this->name.'/' : _THEME_PROD_PIC_DIR_).Configuration::get('STSN_FOOTER_IMG');

	    $theme_settings = array(
            'boxstyle' => (int)Configuration::get('STSN_BOXSTYLE'),
            'footer_img_src' => $footer_img_src, 
            'copyright_text' => Configuration::get('STSN_COPYRIGHT_TEXT', $this->context->language->id),
            'search_label' => Configuration::get('STSN_SEARCH_LABEL', $this->context->language->id),
            'newsletter_label' => Configuration::get('STSN_NEWSLETTER_LABEL', $this->context->language->id),
            'icon_iphone_57' => Configuration::get('STSN_ICON_IPHONE_57') ? $this->_path.Configuration::get('STSN_ICON_IPHONE_57') : '',
            'icon_iphone_72' => Configuration::get('STSN_ICON_IPHONE_72') ? $this->_path.Configuration::get('STSN_ICON_IPHONE_72') : '',
            'icon_iphone_114' => Configuration::get('STSN_ICON_IPHONE_114') ? $this->_path.Configuration::get('STSN_ICON_IPHONE_114') : '',
            'icon_iphone_144' => Configuration::get('STSN_ICON_IPHONE_144') ? $this->_path.Configuration::get('STSN_ICON_IPHONE_144') : '',
            'google_font_links'  => $googleFontLinks,
            'show_cate_header' => Configuration::get('STSN_SHOW_CATE_HEADER'),
            'responsive' => Configuration::get('STSN_RESPONSIVE'),
            'responsive_max' => Configuration::get('STSN_RESPONSIVE_MAX'),
            'scroll_to_top' => Configuration::get('STSN_SCROLL_TO_TOP'),
            'addtocart_animation' => Configuration::get('STSN_ADDTOCART_ANIMATION'),
            'google_rich_snippets' => Configuration::get('STSN_GOOGLE_RICH_SNIPPETS'),
            'display_tax_label' => Configuration::get('STSN_DISPLAY_TAX_LABEL'),
            'discount_percentage' => Configuration::get('STSN_DISCOUNT_PERCENTAGE'),
            'flyout_buttons' => Configuration::get('STSN_FLYOUT_BUTTONS'),
            'length_of_product_name' => Configuration::get('STSN_LENGTH_OF_PRODUCT_NAME'),
            'logo_position' => Configuration::get('STSN_LOGO_POSITION'),
            'body_has_background' => (Configuration::get('STSN_BODY_BG_COLOR') || Configuration::get('STSN_BODY_BG_PATTERN') || Configuration::get('STSN_BODY_BG_IMG')),
            'tracking_code' =>  Configuration::get('STSN_TRACKING_CODE'),
            'categories_per_row' => Configuration::get('STSN_CATEGORIES_PER_ROW'),
            'display_cate_desc_full' => Configuration::get('STSN_DISPLAY_CATE_DESC_FULL'), 
        );
        $this->context->controller->addJS($this->_path.'views/js/global.js');
        if(file_exists($this->local_path.'views/js/customer'.$id_shop.'.js'))
		  $theme_settings['custom_js'] = $this->_path.'views/js/customer'.$id_shop.'.js';
          
        if (Shop::getContext() == Shop::CONTEXT_GROUP  || Shop::getContext() == Shop::CONTEXT_SHOP)
        {
            if(!file_exists($this->local_path.'views/css/customer-g'.$this->context->shop->getContextShopGroupID().'.css'))
                $this->_writeCss();
            $theme_settings['custom_css'] = $this->_path.'views/css/customer-g'.$this->context->shop->getContextShopGroupID().'.css';
        }
        if (Shop::getContext() == Shop::CONTEXT_SHOP)
        {
            if(!file_exists($this->local_path.'views/css/customer-s'.$this->context->shop->getContextShopID().'.css'))
                $this->_writeCss();
            $theme_settings['custom_css'] = $this->_path.'views/css/customer-s'.$this->context->shop->getContextShopID().'.css';
        }
        $theme_settings['custom_css_media'] = 'all';

		if(Configuration::get('STSN_RESPONSIVE'))
        {
            $this->context->controller->addCSS($this->_path.'views/css/responsive.css', 'all');
    		if(Configuration::get('STSN_RESPONSIVE_MAX'))
            {
                for($i=1;$i<=Configuration::get('STSN_RESPONSIVE_MAX');$i++)
                    $this->context->controller->addCSS($this->_path.'views/css/responsive_'.$i.'.css', 'all');
            }
        }
        //
		$this->context->controller->addJqueryPlugin('hoverIntent');
		$this->context->smarty->assign('sttheme', $theme_settings);
		return $this->display(__FILE__, 'stthemeeditor-header.tpl');
	}
    public function getProductSecondaryImg($id_product,$id_cover,$product_link_rewrite,$product_name)
    {
        if(!Configuration::get('STSN_ROLLOVER_IMG_EFFECT'))
            $id_image = $id_cover;
        else
        {
            $id_image = Db::getInstance()->getValue('SELECT i.`id_image`
    				FROM `'._DB_PREFIX_.'image` i
    				'.Shop::addSqlAssociation('image', 'i').'
    				LEFT JOIN `'._DB_PREFIX_.'image_lang` il ON (i.`id_image` = il.`id_image` AND il.`id_lang` = '.(int)$this->context->language->id.')
    				WHERE i.`id_product` = '.(int)$id_product.' AND image_shop.`cover` = 0
    				ORDER BY `position`');
            if(!$id_image)
                $id_image = $id_cover;    
        }

        $this->context->smarty->assign(array(
            'id_image'  => $id_image,
            'product_link_rewrite'  => $product_link_rewrite,
            'product_name'  => $product_name,
			'homeSize' => Image::getSize(ImageType::getFormatedName('home')),
        ));    
		return $this->display(__FILE__, 'product_secondary_img.tpl');
    }
    public function getProductRatingAverage($id_product)
    {
        if(Configuration::get('STSN_DISPLAY_COMMENT_RATING') && Module::isInstalled('productcomments') && Module::isEnabled('productcomments'))
        {
            include_once(_PS_MODULE_DIR_.'productcomments/ProductComment.php');
            $averageGrade = ProductComment::getAverageGrade($id_product);
            if(Configuration::get('STSN_DISPLAY_COMMENT_RATING')==1 && !$averageGrade['grade'])
                return ;
    	    $this->context->smarty->assign('ratingAverage',round($averageGrade['grade']));
            return $this->display(__FILE__, 'product_rating_average.tpl');
        }
        return false;
    }
    public function getProductAttributes($id_product)
    {
        if(!$show_pro_attr = Configuration::get('STSN_DISPLAY_PRO_ATTR'))
            return false;
        $product = new Product($id_product);
		if (!isset($product) || !Validate::isLoadedObject($product))
            return false;
		$groups = array();
		$attributes_groups = $product->getAttributesGroups($this->context->language->id);
        if (is_array($attributes_groups) && $attributes_groups)
		{
            foreach ($attributes_groups as $k => $row)
			{
			     if (!isset($groups[$row['id_attribute_group']]))
					$groups[$row['id_attribute_group']] = array(
						'name' => $row['public_group_name'],
						'group_type' => $row['group_type'],
						'default' => -1,
					);
                $groups[$row['id_attribute_group']]['attributes'][$row['id_attribute']] = $row['attribute_name'];
				if (!isset($groups[$row['id_attribute_group']]['attributes_quantity'][$row['id_attribute']]))
					$groups[$row['id_attribute_group']]['attributes_quantity'][$row['id_attribute']] = 0;
				$groups[$row['id_attribute_group']]['attributes_quantity'][$row['id_attribute']] += (int)$row['quantity'];
			}
            $this->context->smarty->assign(array(
				'groups' => $groups,
                'show_pro_attr' => $show_pro_attr,
            ));
            return $this->display(__FILE__, 'product_attributes.tpl');
        }
        return false;
    }
    public function getAddToWhishlistButton($id_product,$show_icon)
    {
        if(Module::isInstalled('blockwishlist') && Module::isEnabled('blockwishlist'))
        {
    	    $this->context->smarty->assign(array(
                'id_product' => $id_product,
                'show_icon' => $show_icon,
            ));
            return $this->display(__FILE__, 'product_add_to_wishlist.tpl');
        }
    }
    public function getManufacturerLink($id_manufacturer)
    {
	    if (!$this->isCached('manufacturer_link.tpl', $this->stGetCacheId($id_manufacturer,'manufacturer_link')))
        {
		  	$this->context->smarty->assign(array(
              'product_manufacturer' => new Manufacturer((int)$id_manufacturer, $this->context->language->id),
            ));
        }
         
        return $this->display(__FILE__, 'manufacturer_link.tpl',$this->stGetCacheId($id_manufacturer,'manufacturer_link'));
    }
    public function getCarouselJavascript($identify)
    {
	    if (!$this->isCached('carousel_javascript.tpl', $this->stGetCacheId($identify)))
        {
            if($identify=='crossselling')
                $pre = 'STSN_CS';
            else if($identify=='accessories')
                $pre = 'STSN_AC';
            else if($identify=='productscategory')
                $pre = 'STSN_PC';
            else if($identify=='bestsellers')
                $pre = 'STSN_BS';
            if(!isset($pre))
                return false;
            $this->context->smarty->assign(array(
                'identify' => $identify,
                'easing' => self::$easing[Configuration::get($pre.'_EASING')]['name'],
                'slideshow' => Configuration::get($pre.'_SLIDESHOW'),
                's_speed' => Configuration::get($pre.'_S_SPEED'),
                'a_speed' => Configuration::get($pre.'_A_SPEED'),
                'pause_on_hover' => Configuration::get($pre.'_PAUSE_ON_HOVER'),
                'loop' => Configuration::get($pre.'_LOOP'),
                'move' => Configuration::get($pre.'_MOVE'),
                'items' => Configuration::get($pre.'_ITEMS'),
            ));
        }
        return $this->display(__FILE__, 'carousel_javascript.tpl',$this->stGetCacheId($identify));
    }
    
	protected function stGetCacheId($key,$name = null)
	{
		$cache_id = parent::getCacheId($name);
		return $cache_id.'_'.$key;
	}
    
    public function hookDisplayAnywhere($params)
    {
	    if(!isset($params['caller']) || $params['caller']!=$this->name)
            return false;
        if(isset($params['function']) && method_exists($this,$params['function']))
        {
            if($params['function']=='getProductSecondaryImg')
                return call_user_func_array(array($this,$params['function']),array($params['id_product'],$params['id_cover'],$params['product_link_rewrite'],$params['product_name']));
            elseif($params['function']=='getProductRatingAverage')
                return call_user_func_array(array($this,$params['function']),array($params['id_product']));
            elseif($params['function']=='getAddToWhishlistButton')
                return call_user_func_array(array($this,$params['function']),array($params['id_product'],$params['show_icon']));
            elseif($params['function']=='getCarouselJavascript')
                return call_user_func_array(array($this,$params['function']),array($params['identify']));
            elseif($params['function']=='getProductAttributes')
                return call_user_func_array(array($this,$params['function']),array($params['id_product']));
            elseif($params['function']=='getManufacturerLink')
                return call_user_func_array(array($this,$params['function']),array($params['id_manufacturer']));
            elseif($params['function']=='getFlyoutButtonsClass')
                return call_user_func(array($this,$params['function']));
            elseif($params['function']=='getProductNameClass')
                return call_user_func(array($this,$params['function']));
            elseif($params['function']=='getSaleStyleFlag')
                return call_user_func_array(array($this,$params['function']),array($params['percentage_amount'],$params['reduction'],$params['price_without_reduction'],$params['price']));
            elseif($params['function']=='getSaleStyleCircle')
                return call_user_func_array(array($this,$params['function']),array($params['percentage_amount'],$params['reduction'],$params['price_without_reduction'],$params['price']));
            elseif($params['function']=='getLengthOfProductName')
                return call_user_func_array(array($this,$params['function']),array($params['product_name']));
            else
                return false;
        }
        return false;
    }
    public function hookDisplayRightColumnProduct($params)
    {        
	    if(!Module::isInstalled('blockviewed') || !Module::isEnabled('blockviewed'))
            return false;
            
		$id_product = (int)Tools::getValue('id_product');
        if(!$id_product)
            return false;
            
		$productsViewed = (isset($params['cookie']->viewed) && !empty($params['cookie']->viewed)) ? array_slice(array_reverse(explode(',', $params['cookie']->viewed)), 0, Configuration::get('PRODUCTS_VIEWED_NBR')) : array();

		if ($id_product && !in_array($id_product, $productsViewed))
		{
			if(isset($params['cookie']->viewed) && !empty($params['cookie']->viewed))
		  		$params['cookie']->viewed .= ',' . (int)$id_product;
			else
		  		$params['cookie']->viewed = (int)$id_product;
		}
        return false;
    }
    public function getFlyoutButtonsClass()
    {
        return Configuration::get('STSN_FLYOUT_BUTTONS') ? ' hover_fly_static ' : '';
    }
    
    public function getProductNameClass()
    {
        return Configuration::get('STSN_LENGTH_OF_PRODUCT_NAME') ? ' nohidden ' : '';
    }
    
    public function getSaleStyleFlag($percentage_amount,$reduction,$price_without_reduction,$price)
    {
        if(Configuration::get('STSN_DISCOUNT_PERCENTAGE')!=1)
            return false;
        $this->context->smarty->assign(array(
            'percentage_amount'  => $percentage_amount,
            'reduction'  => $reduction,
            'price_without_reduction'  => $price_without_reduction,
			'price' => $price,
        ));    
		return $this->display(__FILE__, 'sale_style_flag.tpl');
    }
    public function getSaleStyleCircle($percentage_amount,$reduction,$price_without_reduction,$price)
    {
        if(Configuration::get('STSN_DISCOUNT_PERCENTAGE')!=2)
            return false;
        $this->context->smarty->assign(array(
            'percentage_amount'  => $percentage_amount,
            'reduction'  => $reduction,
            'price_without_reduction'  => $price_without_reduction,
			'price' => $price,
        ));    
		return $this->display(__FILE__, 'sale_style_circle.tpl');
    }
    public function getLengthOfProductName($product_name)
    {
        $length_of_product_name = Configuration::get('STSN_LENGTH_OF_PRODUCT_NAME');
        $this->context->smarty->assign(array(
            'product_name_full' => $length_of_product_name==2,
            'length_of_product_name'  => ($length_of_product_name==1 ? 70 : 35),
			'product_name' => $product_name,
        ));    
		return $this->display(__FILE__, 'lenght_of_product_name.tpl');
    }
}
