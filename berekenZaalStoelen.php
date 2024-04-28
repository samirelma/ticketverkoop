<?php
include $_SERVER['DOCUMENT_ROOT'] . "/connect/connect.php";
function berekenZaalBlokken($categorie, $zaalID)
{
    if ($zaalID == 2) {
        if ($categorie == 1) {
            $Bloklist = array(001, 002, 003, 004, 005, 006);
            return $Bloklist;
        } elseif ($categorie == 2) {
            $Bloklist = array(113, 114, 115, 116, 117, 118, 119, 120, 121, 122, 123, 130, 131, 132, 133, 134, 135, 136, 137, 144, 145, 146, 147, 148, 149, 150, 151, 152, 153, 154);
            return $Bloklist;
        } elseif ($categorie == 3) {
            $Bloklist = array(219, 221, 222, 223, 224, 225, 226, 227, 228, 229, 230, 231, 232, 233, 234, 235, 236, 237, 238, 239, 240, 241, 242, 244);
            return $Bloklist;
        } else {
            return null;
        }
    } else {
        if ($categorie == 1) {
            $Bloklist = array(001, 002, 003, 004);
            return $Bloklist;
        } elseif ($categorie == 2) {
            $Bloklist = array(112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122, 123, 124, 125, 126, 127, 128, 129, 130, 131, 132, 133, 134, 135, 136, 137, 138, 139, 140, 141, 142, 143, 144, 145, 146, 147, 148, 149, 150, 151, 152);
            return $Bloklist;
        } elseif ($categorie == 3) {
            $Bloklist = array(212, 213, 214, 215, 216, 217, 218, 219, 220, 221, 222, 223, 224, 225, 226, 227, 228, 229, 230, 231, 232, 233, 234, 235, 236, 237, 238, 239, 240, 241, 242, 243, 244, 245, 246, 247, 248, 249);
            return $Bloklist;
        } else {
            return null;
        }
    }
}
function berekenZaalStoel($mysqli, $evenementID, $blok, $zaalID) {
    $sql = "SELECT stoel FROM user_purchases WHERE evenementID = $evenementID AND blok = $blok";
    $resultaat = $mysqli->query($sql);
    $stoeldata = ($resultaat->num_rows == 0) ? false : $resultaat->fetch_all(MYSQLI_ASSOC);
    if ($stoeldata == false) {
        $stoelBezet[] = 0; 
    } else {
        foreach ($stoeldata as $stoel) {
            $stoelBezet[] = $stoel["stoel"]; 
        }
    }
    if ($zaalID == 2) {
    if (($blok >= 1)&&($blok <= 6)) {
        $aantalStoelen = 80*4; 
        $stoelList = array();
        for ($stoel = 1; $stoel <= $aantalStoelen; $stoel ++) {
        if (!in_array($stoel, $stoelBezet)) {
          $stoelList[] = $stoel;
    }
}
        return $stoelList; 
    } elseif ((($blok >= 113)&&($blok <= 120))||(($blok >= 131)&&($blok <= 136))||(($blok >= 147)&&($blok <= 152))) {
        $aantalStoelen = 80*2; 
        $stoelList = array();
        for ($stoel = 1; $stoel <= $aantalStoelen; $stoel ++) {
            if (!in_array($stoel, $stoelBezet)) {
                $stoelList[] = $stoel;
          }
    }
        return $stoelList; 
    } elseif ((($blok >= 219)&& ($blok <= 249))||(($blok >= 137)&& ($blok <= 146))||(($blok >= 121)&& ($blok <= 130))) {
        $aantalStoelen = 80; 
        $stoelList = array();
        for ($stoel = 1; $stoel <= $aantalStoelen; $stoel ++) {
            if (!in_array($stoel, $stoelBezet)) {
                $stoelList[] = $stoel;
          }
        }
        return $stoelList; 
}
    } else if ($zaalID == 1) {
        if (($blok >= 1)&&($blok <= 4)) {
            $aantalStoelen = 37*4; 
            $stoelList = array();
            for ($stoel = 1; $stoel <= $aantalStoelen; $stoel ++) {
                if (!in_array($stoel, $stoelBezet)) {
                    $stoelList[] = $stoel;
              }
        }
            return $stoelList; 
        } elseif (($blok >= 112)&&($blok <= 152)) {
            $aantalStoelen = 37*2; 
            $stoelList = array();
            for ($stoel = 1; $stoel <= $aantalStoelen; $stoel ++) {
                if (!in_array($stoel, $stoelBezet)) {
                    $stoelList[] = $stoel;
              }
        }
            return $stoelList; 
        } elseif (($blok >= 212)&& ($blok <= 249)) {
            $aantalStoelen = 37; 
            $stoelList = array();
            for ($stoel = 1; $stoel <= $aantalStoelen; $stoel ++) {
                if (!in_array($stoel, $stoelBezet)) {
                    $stoelList[] = $stoel;
              }
            }
            return $stoelList; 
    }  
    }
}
?>