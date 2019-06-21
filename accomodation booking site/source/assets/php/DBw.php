<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

/**
 * Class db
 */
class DBw {
    public $dbh = null;
    public $message = null;

    // Constructor.
    public function __construct() {
        try {
            $this->dbh = new PDO("mysql:host=localhost;dbname=BigfeetDB", "admin", "GdIqnPv6j7wZ");
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $x) {
            $this->dbh = null;
            $this->message = $x->getMessage();
        }
    }
    public function searchTitle($name = "") {
        if (is_null($this->dbh)) {
            return null;
        }

        try {
            $name = '%'.$name.'%';
            $sth = $this->dbh->prepare("SELECT * FROM Listings WHERE Name LIKE ? LIMIT 5 OFFSET 0");
            $sth->bindParam(1, $name, PDO::PARAM_STR,strlen($name));
            $sth->execute();
            $rows = $sth->fetchAll(PDO::FETCH_CLASS, 'Listing');
            $sth->closeCursor();
        } catch(PDOException $x) {
            $this->message = $x->getMessage();
            return null;
        }
        return $rows;
    }
    public function searchLocation($location = "") {
        if (is_null($this->dbh)) {
            return null;
        }

        try {
            $location = '%'.$location.'%';
            $sth = $this->dbh->prepare("SELECT * FROM Listings WHERE Street LIKE ? OR State LIKE ? OR City LIKE ? OR Postal LIKE ? OR Nationality LIKE ?  LIMIT 5 OFFSET 0");
            $sth->bindParam(1, $location, PDO::PARAM_STR,strlen($location));
            $sth->bindParam(2, $location, PDO::PARAM_STR,strlen($location));
            $sth->bindParam(3, $location, PDO::PARAM_STR,strlen($location));
            $sth->bindParam(4, $location, PDO::PARAM_STR,strlen($location));
            $sth->bindParam(5, $location, PDO::PARAM_STR,strlen($location));
            $sth->execute();
            $rows = $sth->fetchAll(PDO::FETCH_CLASS, 'Listing');
            $sth->closeCursor();
        } catch(PDOException $x) {
            $this->message = $x->getMessage();
            return null;
        }
        return $rows;
    }

    public function searchName($name = "", $off = "",$guests = "",$type = "",$sort = "",$amenities = "") {
        if (is_null($this->dbh)) {
            return null;
        }

        try {
            $name = '%'.$name.'%';
            $off = intval($off);
            if ($sort == 1) {
              $sth = $this->dbh->prepare("SELECT * FROM Listings WHERE Name LIKE ? AND Type LIKE ? AND Amenities & ? != 0 LIMIT 10 OFFSET ?");
            } elseif ($sort == 2) {
              $sth = $this->dbh->prepare("SELECT * FROM Listings WHERE Name LIKE ? AND Type LIKE ? AND Amenities & ? != 0 ORDER BY Price ASC LIMIT 10 OFFSET ? ");
            } else {
              $sth = $this->dbh->prepare("SELECT * FROM Listings WHERE Name LIKE ? AND Type LIKE ? AND Amenities & ? != 0 ORDER BY Rating DESC LIMIT 10 OFFSET ?");
            }
            if ($guests == 0) {
                $guests = '%';
            } else {
                $guests = strval($guests);
            }

            if ($type == 0) {
                $type = '%';
            } else {
                $type = strval($type);
            }

            $amenities = (int) $amenities;
            if ($amenities == 0) {
              $amenities = 16777215;
            }

            //$sth->bindParam(2, $guests, PDO::PARAM_STR,strlen($guests));
            $sth->bindParam(1, $name, PDO::PARAM_STR,strlen($name));
            $sth->bindParam(2, $type, PDO::PARAM_STR,strlen($type));
            $sth->bindParam(3, $amenities, PDO::PARAM_INT);
            $sth->bindParam(4, $off, PDO::PARAM_INT);

            $sth->execute();
            $rows = $sth->fetchAll(PDO::FETCH_CLASS, 'Listing');
            $sth->closeCursor();
        } catch(PDOException $x) {
            $this->message = $x->getMessage();
            return null;
        }
        return $rows;
    }

    public function searchPrice($name = "", $off = "",$guests = "",$type = "",$sort = "",$amenities = "",$price = "") {
        if (is_null($this->dbh)) {
            return null;
        }
        try {
            $name = '%'.$name.'%';
            $off = intval($off);
            if ($guests == 0) {
                $guests = '%';
            } else {
                $guests = strval($guests);
            }
            if ($type == 0) {
                $type = '%';
            } else {
                $type = strval($type);
            }
            $amenities = (int) $amenities;
            if ($amenities == 0) {
              $amenities = 16777215;
            }

            $sort = (int) $sort;
            $price = (int) $price;
            if ( $sort == 1) {
              if ($price == -1) {
                  $sth = $this->dbh->prepare("SELECT * FROM Listings WHERE Name LIKE ? AND Type LIKE ? AND Amenities & ? != 0 LIMIT 10 OFFSET ?");
                  $sth->bindParam(4, $off, PDO::PARAM_INT);
              } elseif ( $price == 10000) {
                  $price = 10000;
                  $sth = $this->dbh->prepare("SELECT * FROM Listings WHERE Name LIKE ? AND Type LIKE ? AND Amenities & ? != 0 AND Price >= ? LIMIT 10 OFFSET ?");
                  $sth->bindParam(4, $price, PDO::PARAM_INT);
                  $sth->bindParam(5, $off, PDO::PARAM_INT);
              } else {
                $sth = $this->dbh->prepare("SELECT * FROM Listings WHERE Name LIKE ? AND Type LIKE ? AND Amenities & ? != 0 AND Price <= ? LIMIT 10 OFFSET ?");
                $sth->bindParam(4, $price, PDO::PARAM_INT);
                $sth->bindParam(5, $off, PDO::PARAM_INT);
              }
            } elseif ($sort == 2) {
              if ($price == -1) {
                  $sth = $this->dbh->prepare("SELECT * FROM Listings WHERE Name LIKE ? AND Type LIKE ? AND Amenities & ? != 0 ORDER BY Price ASC LIMIT 10 OFFSET ?");
                  $sth->bindParam(4, $off, PDO::PARAM_INT);
              } elseif ( $price == 10000) {
                  $price = 10000;
                  $sth = $this->dbh->prepare("SELECT * FROM Listings WHERE Name LIKE ? AND Type LIKE ? AND Amenities & ? != 0 AND Price >= ? ORDER BY Price ASC LIMIT 10 OFFSET ?");
                  $sth->bindParam(4, $price, PDO::PARAM_INT);
                  $sth->bindParam(5, $off, PDO::PARAM_INT);
              } else {
                $sth = $this->dbh->prepare("SELECT * FROM Listings WHERE Name LIKE ? AND Type LIKE ? AND Amenities & ? != 0 AND Price <= ? ORDER BY Price ASC LIMIT 10 OFFSET ?");
                $sth->bindParam(4, $price, PDO::PARAM_INT);
                $sth->bindParam(5, $off, PDO::PARAM_INT);
              }
            } else {
              if ($price == -1) {
                  $sth = $this->dbh->prepare("SELECT * FROM Listings WHERE Name LIKE ? AND Type LIKE ? AND Amenities & ? != 0 ORDER BY Rating DESC LIMIT 10 OFFSET ?");
                  $sth->bindParam(4, $off, PDO::PARAM_INT);
              } elseif ( $price == 10000) {
                  $price = 10000;
                  $sth = $this->dbh->prepare("SELECT * FROM Listings WHERE Name LIKE ? AND Type LIKE ? AND Amenities & ? != 0 AND Price >= ? ORDER BY Rating DESC LIMIT 10 OFFSET ?");
                  $sth->bindParam(4, $price, PDO::PARAM_INT);
                  $sth->bindParam(5, $off, PDO::PARAM_INT);
              } else {
                $sth = $this->dbh->prepare("SELECT * FROM Listings WHERE Name LIKE ? AND Type LIKE ? AND Amenities & ? != 0 AND Price <= ? ORDER BY Rating DESC LIMIT 10 OFFSET ?");
                $sth->bindParam(4, $price, PDO::PARAM_INT);
                $sth->bindParam(5, $off, PDO::PARAM_INT);
              }
            }
            $sth->bindParam(1, $name, PDO::PARAM_STR,strlen($name));
            $sth->bindParam(2, $type, PDO::PARAM_STR,strlen($type));
            $sth->bindParam(3, $amenities, PDO::PARAM_INT);
            $sth->execute();
            $rows = $sth->fetchAll(PDO::FETCH_CLASS, 'Listing');
            $sth->closeCursor();
        } catch(PDOException $x) {
            $this->message = $x->getMessage();
            return null;
        }
        return $rows;
    }

    public function searchRatings($name = "", $off = "",$guests = "",$type = "",$sort = "",$amenities = "",$ratings = "") {
        if (is_null($this->dbh)) {
            return null;
        }
        try {
            $name = '%'.$name.'%';
            $off = intval($off);
            if ($guests == 0) {
                $guests = '%';
            } else {
                $guests = strval($guests);
            }
            if ($type == 0) {
                $type = '%';
            } else {
                $type = strval($type);
            }
            $amenities = (int) $amenities;
            if ($amenities == 0) {
              $amenities = 16777215;
            }
            if ( $sort == 1 ) {
              if ($ratings == -1) {
                  $sth = $this->dbh->prepare("SELECT * FROM Listings WHERE Name LIKE ? AND Type LIKE ? AND Amenities & ? != 0 LIMIT 10 OFFSET ?");
                  $sth->bindParam(4, $off, PDO::PARAM_INT);
              } else {
                $sth = $this->dbh->prepare("SELECT * FROM Listings WHERE Name LIKE ? AND Type LIKE ? AND Amenities & ? != 0 AND Rating <= ? LIMIT 10 OFFSET ?");
                $sth->bindParam(4, $ratings, PDO::PARAM_INT);
                $sth->bindParam(5, $off, PDO::PARAM_INT);
              }
            } elseif ( $sort == 2 ) {
              if ($ratings == -1) {
                  $sth = $this->dbh->prepare("SELECT * FROM Listings WHERE Name LIKE ? AND Type LIKE ? AND Amenities & ? != 0 ORDER BY Price ASC LIMIT 10 OFFSET ?");
                  $sth->bindParam(4, $off, PDO::PARAM_INT);
              } else {
                $sth = $this->dbh->prepare("SELECT * FROM Listings WHERE Name LIKE ? AND Type LIKE ? AND Amenities & ? != 0 AND Rating <= ? ORDER BY Price ASC LIMIT 10 OFFSET ?");
                $sth->bindParam(4, $ratings, PDO::PARAM_INT);
                $sth->bindParam(5, $off, PDO::PARAM_INT);
              }
            } else {
              if ($ratings == -1) {
                  $sth = $this->dbh->prepare("SELECT * FROM Listings WHERE Name LIKE ? AND Type LIKE ? AND Amenities & ? != 0 ORDER BY Rating DESC LIMIT 10 OFFSET ?");
                  $sth->bindParam(4, $off, PDO::PARAM_INT);
              } else {
                $sth = $this->dbh->prepare("SELECT * FROM Listings WHERE Name LIKE ? AND Type LIKE ? AND Amenities & ? != 0 AND Rating <= ? ORDER BY Rating DESC LIMIT 10 OFFSET ?");
                $sth->bindParam(4, $ratings, PDO::PARAM_INT);
                $sth->bindParam(5, $off, PDO::PARAM_INT);
              }
            }

            //$sth->bindParam(2, $guests, PDO::PARAM_STR,strlen($guests));
            $sth->bindParam(1, $name, PDO::PARAM_STR,strlen($name));
            $sth->bindParam(2, $type, PDO::PARAM_STR,strlen($type));
            $sth->bindParam(3, $amenities, PDO::PARAM_INT);

            $sth->execute();
            $rows = $sth->fetchAll(PDO::FETCH_CLASS, 'Listing');
            $sth->closeCursor();
        } catch(PDOException $x) {
            $this->message = $x->getMessage();
            return null;
        }
        return $rows;
    }
}
