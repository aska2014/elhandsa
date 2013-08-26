<?php
 
/*
* File: SimpleImage.php
* Author: Simon Jarvis
* Copyright: 2006 Simon Jarvis
* Date: 08/11/06
* Link: http://www.white-hat-web-design.co.uk/articles/php-image-resizing.php
*
* This program is free software; you can redistribute it and/or
* modify it under the terms of the GNU General Public License
* as published by the Free Software Foundation; either version 2
* of the License, or (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details:
* http://www.gnu.org/licenses/gpl.html
*
*/
 
class SimpleImage {
 
   var $image;
   var $image_type;
   var $tmp_name;
 
   function load($filename) {
 
      $this->tmp_name = $filename;
      $image_info = getimagesize($filename);
      $this->image_type = $image_info[2];
      if( $this->image_type == IMAGETYPE_JPEG ) {
 
         $this->image = imagecreatefromjpeg($filename);
      } elseif( $this->image_type == IMAGETYPE_GIF ) {
 
         $this->image = imagecreatefromgif($filename);
      } elseif( $this->image_type == IMAGETYPE_PNG ) {
 
         $this->image = imagecreatefrompng($filename);
      }
   }

   function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {
 
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image,$filename,$compression);
      } elseif( $image_type == IMAGETYPE_GIF ) {
 
         imagegif($this->image,$filename);
      } elseif( $image_type == IMAGETYPE_PNG ) {
 
         imagepng($this->image,$filename);
      }
      if( $permissions != null) {
 
         chmod($filename,$permissions);
      }
   }
   function output($image_type=IMAGETYPE_JPEG) {
 
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image);
      } elseif( $image_type == IMAGETYPE_GIF ) {
 
         imagegif($this->image);
      } elseif( $image_type == IMAGETYPE_PNG ) {
 
         imagepng($this->image);
      }
   }
   function getWidth() {
 
      return imagesx($this->image);
   }
   function getHeight() {
 
      return imagesy($this->image);
   }
   function resizeToHeight($height) {
 
      $ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $ratio;
      $this->resize($width,$height);
   }
 
   function resizeToWidth($width) {
      $ratio = $width / $this->getWidth();
      $height = $this->getheight() * $ratio;
      $this->resize($width,$height);
   }
 
   function scale($scale) {
      $width = $this->getWidth() * $scale/100;
      $height = $this->getheight() * $scale/100;
      $this->resize($width,$height);
   }
 
   function resize($width,$height) {
      $new_image = imagecreatetruecolor($width, $height);
      imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
      $this->image = $new_image;
   }


   public function member_resize($nw, $nh, $img_file)
   {

      //VARIABLES

      $img = $this->tmp_name;

      $img_file = explode("/", $img_file);
      $img_name = $img_file[1];

      $tpath = path('public').DS."albums".DS.$img_file[0];

      /*
      You will need to go down in the code below, and change the image names. Currently it is set as "$img".
      The outputted thumbnail's name is: "$thumb".
      */

      $dimensions = GetImageSize($img);

      $thname = "$tpath/$img_name";

      $w=$dimensions[0];
      $h=$dimensions[1];

      $img2 = ImageCreateFromJpeg($img);
      $thumb=ImageCreateTrueColor($nw,$nh);
         
      $wm = $w/$nw;
      $hm = $h/$nh;
         
      $h_height = $nh/2;
      $w_height = $nw/2;
         
      if($w > $h){
         
         $adjusted_width = $w / $hm;
         $half_width = $adjusted_width / 2;
         $int_width = $half_width - $w_height;
         
         ImageCopyResampled($thumb,$img2,-$int_width,0,0,0,$adjusted_width,$nh,$w,$h); 
         ImageJPEG($thumb,$thname,95); 
         
      }elseif(($w < $h) || ($w == $h)){
         
         $adjusted_height = $h / $wm;
         $half_height = $adjusted_height / 2;
         $int_height = $half_height - $h_height;
         
         ImageCopyResampled($thumb,$img2,0,-$int_height,0,0,$nw,$adjusted_height,$w,$h); 
         ImageJPEG($thumb,$thname,95); 
         
      }else{
         ImageCopyResampled($thumb,$img2,0,0,0,0,$nw,$nh,$w,$h);  
         ImageJPEG($thumb,$thname,95); 
      }

      imagedestroy($img2);
   }
 
}