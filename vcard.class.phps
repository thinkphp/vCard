<?php

 /*

   Filename: vcard.class.php
   Author: Adrian Statescu
   Last Modified: 22:05AM 2009
   Description: A class to generate vCards for contact data

 */


    class vcard {

          public $log;

          //array of this vcards`s contact data 
          public $data = array();  

          private $filename; //filename for download 

          //class for PUBLIC, PRIVATE, CONFIDENTIAL
          private $class;

          private $card;

          private $revision_data;

                  //constructor of this class
                  public function __construct() {

                         $this->log = 'new vcard() is called<br/>';

                         $this->data = array(

                                             'display_name'=>null,  

                                             'first_name'=>null,

                                             'last_name'=>null, 

                                             'additional_name'=>null,

                                             'name_prefix'=>null,

                                             'name_suffix'=>null,

                                             'nickname'=>null,

                                             'title'=>null,

                                             'role'=>null,

                                             'departament'=>null,

                                             'company'=>null,

                                             'work_po_box'=>null,

                                             'work_extended_address'=>null,

                                             'work_address'=>null,

                                             'work_city'=>null,

                                             'work_state'=>null,

                                             'work_postal_code'=>null,

                                             'work_country'=>null,

                                             'home_po_box'=>null,

                                             'home_extended_address'=>null,

                                             'home_address'=>null,

                                             'home_city'=>null,

                                             'home_state'=>null,

                                             'home_postal_code'=>null,

                                             'home_country'=>null,

                                             'office_tel'=>null,

                                             'home_tel'=>null,

                                             'cell_tel'=>null,

                                             'fax_tel'=>null,

                                             'pager_tel'=>null,

                                             'email1'=>null,

                                             'email2'=>null,

                                             'url'=>null,

                                             'photo'=>null,

                                             'birthday'=>null,

                                             'timezone'=>null,

                                             'sort_string'=>null,

                                             'note'=>null

                                            );
                  }//end constructor

                  //some methods
                  public function build() {

                         $this->log .= 'Method build() called;<br/>';

                         if(!$this->class) {$this->class = "PUBLIC";}

                         if(!$this->data['display_name']) {

                                        $this->data['display_name'] = trim($this->data['first_name']." ".$this->data['last_name']);;
                         }


                         if(!$this->data['timezone']) {$this->data['timezone'] = date("O");}

                         if(!$this->data['revision_date']) {$this->revision_date = date("Y-m-d H:i:s");}                         

                          //--->begin card

                            $this->card = "BEGIN:VCARD\r\n";

                            $this->card .= "VERSION:3.0\r\n";

                            $this->card .= "CLASS:". $this->class."\r\n";

                            $this->card .= "PROID:-//class_vcard from thinkphp.ro//NONSGML Version 1//EN\r\n";

                            $this->card .= "REV:". $this->revision_date."\r\n";

                            $this->card .= "FN:". $this->data['display_name']."\r\n";

                            $this->card .="N:".$this->data['first_name'].";".$this->data['last_name'].";".$this->data['additional_name'].";".$this->data['name_prefix'].";".$this->data['name_suffix']."\r\n";

                          if($this->data['nickname']) { $this->card .= "NICKNAME:". $this->data['nickname']. "\r\n";}

                          if($this->data['title']) { $this->card .= "TITLE:". $this->data['title']. "\r\n"; }

                          if($this->data['company']) { $this->card .= "ORG:". $this->data['company']; }

                          if($this->data['departament']) { $this->card .= ";".$this->data['departament']; }

                          $this->card .= "\r\n";

                          if($this->data['work_po_box'] || $this->data['work_extended_address'] || $this->data['work_address'] || $this->data['work_city'] || $this->data['work_state'] || $this->data['work_postal_code'] || $this->data['work_country']) {


                                        $this->card .="ADR;TYPE=work:".$this->data['work_po_box'].";".$this->data['work_extended_address'].";".$this->data['work_address'].";".$this->data['work_city'].";".$this->data['work_state'].";".$this->data['work_postal_code'].";".$this->data['work_country']."\r\n";

                          }


                          if ($this->data['home_po_box'] || $this->data['home_extended_address'] || $this->data['home_address'] || $this->data['home_city'] || $this->data['home_state'] || $this->data['home_postal_code'] || $this->data['home_country']) {

                                        $this->card .="ADR;TYPE=work:".$this->data['home_po_box'].";".$this->data['home_extended_address'].";".$this->data['home_address'].";".$this->data['home_city'].";".$this->data['home_state'].";".$this->data['home_postal_code'].";".$this->data['home_country']."\r\n";
                          }

                          if($this->data['email1']) {$this->card .= "EMAIL;TYPE=internet,pref:".$this->data['email1']."\r\n";}

                          if($this->data['email2']) {$this->card .= "EMAIL;TYPE=internet:".$this->data['email2']."\r\n";}

                          if($this->data['office_tel']) {$this->card .= "TEL;TYPE=work,voice:".$this->data['office_tel']."\r\n";}

                          if($this->data['home_tel']) {$this->card .= "TEL;TYPE=home,voice:".$this->data['home_tel']."\r\n";}

                          if($this->data['cell_tel']) {$this->card .= "TEL;TYPE=cell,voice:".$this->data['cell_tel']."\r\n";}

                          if($this->data['fax_tel']) {$this->card .= "TEL;TYPE=work,fax:".$this->data['fax_tel']."\r\n";}

                          if($this->data['pager_tel']) {$this->card .= "TEL;TYPE=work,pager:".$this->data['pager_tel']."\r\n";}

                          if($this->data['url']) {$this->card .= "URL;TYPE=work:".$this->data['url']."\r\n";}

                                      if($this->data['birthday']) {$this->card .= "BDAY:".$this->data['birthday']."\r\n";}

                                      if($this->data['role']) {$this->card .= "ROLE:".$this->data['role']."\r\n";}

                                      if($this->data['note']) {$this->card .= "NOTE:".$this->data['note']."\r\n";}

                          $this->card .="END:VCARD\r\n";

                          //--->end card 
                          
                  }//end function

                  public function download() {

                         $this->log .= 'Method download() called;</br>';

                         if(!$this->card) $this->build(); 

                         if(!$this->filename) { $this->filename = trim($this->data['display_name']);}

                             $this->filename = str_replace(" ","_",$this->filename);

                             header("Content-type: text/directory");

                             header("Content-Disposition: attachment;filename=".$this->filename.".vcf");

                             header("Pragma: public");
  
                             echo$this->card;

                           return true;

                  }//end function

   }//end class


?>