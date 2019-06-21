<?php
define('__ROOT__', dirname(dirname(__FILE__)));
include __ROOT__ . '/database/classes/User.php';
include __ROOT__ . '/database/classes/Booking.php';
include __ROOT__ . '/database/classes/History.php';
include __ROOT__ . '/database/classes/Listing.php';
include __ROOT__ . '/database/classes/Review.php';
include __ROOT__ . '/database/classes/Favorites.php';

class db
{
    public $dbh;
    public $message;

    // Constructor.
    public function __construct() {
        try {
            $this->dbh = new PDO('mysql:host=localhost;dbname=BigfeetDB', 'admin', 'GdIqnPv6j7wZ');
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $x) {
            $this->dbh = null;
            $this->message = $x->getMessage();
        }
    }

    /**
     *
     */
    public function editUserProfile($userEmail, $userData) {
        try {
            $sqlCommand = /** @lang */
                'UPDATE Users SET Name=:fname, Surname=:lname, Street=:saddress, State=:state, City=:city,
                                    Postal=:pcode, Bio=:pbio WHERE Email=:email';
            $data = array(
                ':fname'    => $userData['fname'],
                ':lname'    => $userData['lname'],
                ':saddress' => $userData['saddress'],
                ':state'    => $userData['state'],
                ':city'     => $userData['city'],
                ':pcode'    => $userData['pcode'],
                ':pbio'     => $userData['pbio'],
                ':email'    => $userEmail
            );
            $this->dbh->prepare($sqlCommand)->execute($data);
        } catch (PDOException $x) {
            $this->message = $x->getMessage();
            return false;
        }
        return true;
    }

 //   public function deleteListing($listing_id) {

   // }

    public function editListing($newListingDetails) {
        try {
            $sqlCommand = 'UPDATE Listings SET Nationality=:nation, Type=:type, Price=:price, About=:blurb,
                                               Street=:str, City=:city, State=:state, Postal=:post, Latitude=:lati, Longitude=:long, NumOfGuests=:numG
                                               WHERE ID=:id';
            $this->dbh->prepare($sqlCommand)->execute($newListingDetails);
        } catch (PDOException $x) {
            $this->message = $x->getMessage();
            return false;
        }
        return true;
    }

    /**
     * @param $email
     * @return null
     */
    public function getUser($email) {
        if ($this->dbh === null) { return null; }
        try {
            $sth = $this->dbh->prepare(/** @lang */'SELECT * FROM Users WHERE Email = :email');
            $sth->execute(array(':email' => $email));
            $sth->setFetchMode(PDO::FETCH_CLASS, 'User');
            $row = $sth->fetch();
            $sth->closeCursor();
            return (false === $row) ? null : $row;
        } catch (PDOException $x) {
            $this->message = $x->getMessage();
            return  $this->message;
        }
    }

    /**
     * NOTE: this is not how it is done! if a user forgot a password he should provide
     *       their account email adress and an email should be sent to their email
     *       address with a link that would take them to a page for changing their
     *       email address. it is vital to know that the user changing the password
     *       owns the account or email address. because with this functionality a
     *       non-acount own can change the password of a user given the attacker
     *       has an existing victim email address.
     *
     *       this functionality should be changed if we can manage to get the email
     *       functionality working.
     *
     * @param newPassword   the new password to be used.
     * @param userEmail     the email address of the forgoten password.
     * @return bool
     */
    public function forgotPassword($newPassword, $userEmail) {
        try {
            $sqlCommand = 'UPDATE Users SET Hash=:hash WHERE Email=:email';
            $data = array(
                ':hash'  => crypt($newPassword, 'BigFeet'),
                ':email' => $userEmail,
            );
            $this->dbh->prepare($sqlCommand)->execute($data);
            return true;
        } catch(PDOException $x) {
            $this->message = $x->getMessage();
            return false;
        }
    }

    /**
     * @param $oldPassword
     * @param $newPassword
     * @param $userEmail
     * @return bool|string
     */
    public function resetPassword($oldPassword, $newPassword, $userEmail) {
        $user = $this->getUser($userEmail);
        try {
            if ($user->Hash === crypt($oldPassword, 'BigFeet')) {
                $sqlCommand = 'UPDATE Users SET Hash=:hash WHERE Email=:email';
                $data = array(
                    ':hash'  => crypt($newPassword, 'BigFeet'),
                    ':email' => $user->Email,
                );
                $this->dbh->prepare($sqlCommand)->execute($data);
                return true;
            }
        } catch(PDOException $x) { $this->message = $x->getMessage(); }
        return false;
    }

    /**
     * @param $page
     * @return null
     */
    public function getUsers($page) {
        if ($this->dbh === null) { return null; }
        $limit = (($page - 1) * 50);
        $sql = /** @lang */'SELECT * FROM Users LIMIT ' . $limit. ',50';
        try {
            $sth = $this->dbh->prepare(/** @lang **/ $sql);
            $sth->execute();
            $sth->setFetchMode(PDO::FETCH_GROUP|PDO::FETCH_CLASS, 'User');
            $row = $sth->fetchAll();
            $sth->closeCursor();
            return (false === $row) ? null : $row;
        } catch (PDOException $x) {
            $this->message = $x->getMessage();
            return null;
        }
    }

    public function editCardDetails($userEmail, $newCardData) {
        try {
            $sqlCommand = 'UPDATE Users SET Card_Holder=:name, Card_Number=:number, Card_Month=:month, Card_Year=:year, Card_Type=:type, CVV=:cvv WHERE Email=:email';
            $updateData = array(
                                ':name'   => $newCardData['cardH'],
                                ':number' => $newCardData['cardN'],
                                ':month'  => $newCardData['cardM'],
                                ':year'   => $newCardData['cardY'],
                                ':type'   => $newCardData['cardT'],
                                ':cvv'    => $newCardData['cardC'],
                                ':email'  => $userEmail
            );
            $this->dbh->prepare($sqlCommand)->execute($updateData);
        } catch(PDOException $x) {
            $this->message = $x->getMessage();
            return $this->message;
        }
        return true;
    }

    public function getBookings() {
        if ($this->dbh === null) { return null; }
        try {
            $sth = $this->dbh->prepare(/** @lang **/'SELECT * FROM Bookings ORDER BY ID');
            $sth->execute();
            $sth->setFetchMode(PDO::FETCH_GROUP|PDO::FETCH_CLASS, 'Booking');
            $row = $sth->fetchAll();
            $sth->closeCursor();
            return (false === $row) ? null : $row;
        } catch (PDOException $x) {
            $this->message = $x->getMessage();
            return null;
        }
    }

    public function getReviewsByID($id) {
        if ($this->dbh === null) { return null; }
        try {
            $sth = $this->dbh->prepare(/** @lang **/'SELECT * FROM Reviews WHERE ID = :id');
            $sth->execute(array(':id' => $id));
            $sth->setFetchMode(PDO::FETCH_CLASS, 'Review');
            $row = $sth->fetch();
            $sth->closeCursor();
            return ($row === false) ? null : $row;
        } catch (PDOException $x) {
            $this->message = $x->getMessage();
            return null;
        }
    }

    public function getReviewsByListing($listing) {
        if ($this->dbh === null) {
            return null;
        }
        try {
            $sth = $this->dbh->prepare(/** @lang **/'SELECT * FROM Reviews WHERE Listing = :listing');
            $sth->execute(array(':listing' => $listing));
            $sth->setFetchMode(PDO::FETCH_GROUP|PDO::FETCH_CLASS, 'Review');
            $row = $sth->fetchAll();
            $sth->closeCursor();
            return ($row === false) ? null : $row;
        } catch (PDOException $x) {
            $this->message = $x->getMessage();
            return null;
        }
    }

    public function getReviewsByEmail($email) {
        if ($this->dbh === null) {
            return null;
        }
        try {
            $sth = $this->dbh->prepare(/** @lang **/'SELECT * FROM Reviews WHERE Guest = :email');
            $sth->execute(array(':email' => $email));
            $sth->setFetchMode(PDO::FETCH_GROUP|PDO::FETCH_CLASS, 'Review');
            $row = $sth->fetchAll();
            $sth->closeCursor();
            return ($row === false) ? null : $row;
        } catch (PDOException $x) {
            $this->message = $x->getMessage();
            return null;
        }
    }

    public function getUserHistory($email) {
        if ($this->dbh === null) { return null; }
        try {
            $sth = $this->dbh->prepare(/** @lang */'SELECT * FROM History WHERE User = :email');
            $sth->execute(array(':email' => $email));
            $sth->setFetchMode(PDO::FETCH_GROUP|PDO::FETCH_CLASS, 'History');
            $row = $sth->fetchAll();
            $sth->closeCursor();
            return ($row === false) ? null : $row;
        } catch (PDOException $x){
            $this->message = $x->getMessage();
            return null;
        }
    }

    public function getUserHistoryID($listing_id) {
        if ($this->dbh === null) { return null; }
        try {
            $sth = $this->dbh->prepare(/** @lang */'SELECT * FROM History WHERE Listing = :listing_id');
            $sth->execute(array(':listing_id' => $listing_id));
            $sth->setFetchMode(PDO::FETCH_GROUP|PDO::FETCH_CLASS, 'History');
            $row = $sth->fetchAll();
            $sth->closeCursor();
            return ($row === false) ? null : $row;
        } catch (PDOException $x){
            $this->message = $x->getMessage();
            return null;
        }
    }

    public function getHostHistory($email) {
        if ($this->dbh === null) { return null; }
        try {
            $sth = $this->dbh->prepare(/** @lang */'SELECT * FROM History WHERE Host = :email');
            $sth->execute(array(':email' => $email));
            $sth->setFetchMode(PDO::FETCH_GROUP|PDO::FETCH_CLASS, 'History');
            $row = $sth->fetchAll();
            $sth->closeCursor();
            return ($row === false) ? null : $row;
        } catch (PDOException $x){
            $this->message = $x->getMessage();
            return null;
        }
    }

    /**
     * get the number of places a user has gone to and reviewed after visiting the place.
     *
     * @param  $guestEmai    the email of the guest user
     * @return $hCount       the count of the users history activities
     */
    public function getUserReviewsCount($guestEmail) {
        return count($this->getReviewsByEmail($guestEmail));
    }

    /**
     * get the number of places a user has like of book marded.
     *
     * @param  $guestEmail    the email of the guest user.
     * @return $fCount        the count of the users number of favorites.
     */
    public function getUserFavouritesCount($guestEmail) {
        return count($this->getSavedListings($guestEmail));
    }

    /**
     * get the number of places a user has gone to.
     *
     * @param  $guestEmail    the email of the guest user.
     * @return $hCount        the count of the users history activities.
     */
    public function getUserHistoryCount($guestEmail) {
        return count($this->getUserHistory($guestEmail));
    }

    /**
     * get the number of bookings a user has made and that are active.
     *
     * @param  $guestEmail    the email of the guest user.
     * @return $bCount        the active bookings of the user.
     */
    public function getGBookingsCount($guestEmail) {
        return count($this->getUserBookings($guestEmail));
    }


    public function getUserBookings($email) {
        if ($this->dbh === null) { return null; }

        try {
            $sth = $this->dbh->prepare(/** @lang **/'SELECT * FROM Bookings WHERE User = :email');
            $sth->execute(array(':email' => $email));
            $sth->setFetchMode(PDO::FETCH_GROUP|PDO::FETCH_CLASS, 'Booking');
            $row = $sth->fetchAll();
            $sth->closeCursor();
            if (false === $row) {
                return null;
            }
        } catch (PDOException $x) {
            $this->message = $x->getMessage();
            return null;
        }
        return $row;
    }

    /**
     * @param $id
     * @return null
     */
    public function getBooking($id)
    {
        if ($this->dbh === null) {
            return null;
        }
        try {
            $sth = $this->dbh->prepare(/** @lang **/'SELECT * FROM Bookings WHERE ID = :id');
            $sth->execute(array(':id' => $id));
            $sth->setFetchMode(PDO::FETCH_CLASS, 'Booking');
            $row = $sth->fetch();
            $sth->closeCursor();
            if (false === $row) {
                return null;
            }
        } catch (PDOException $x) {
            $this->message = $x->getMessage();
            return null;
        }
        return $row;
    }

    /**
     * @param $id
     * @return null
     */
    public function getListing($id)
    {
        if ($this->dbh === null) {
            return null;
        }
        try {
            $sth = $this->dbh->prepare(/** @lang **/'SELECT * FROM Listings WHERE ID = :id');
            $sth->execute(array(':id' => $id));
            $sth->setFetchMode(PDO::FETCH_CLASS, 'Listing');
            $row = $sth->fetch();
            $sth->closeCursor();
            //var_dump($row);
        } catch (PDOException $x) {
            $this->message = $x->getMessage();
            return null;
        }
        return $row;
    }

    public function getListings($email)
    {
        if ($this->dbh === null) {
            return null;
        }
        try {
            $sth = $this->dbh->prepare(/** @lang **/'SELECT * FROM Listings WHERE Host = :email');
            $sth->execute(array(':email' => $email));
            $sth->setFetchMode(PDO::FETCH_GROUP|PDO::FETCH_CLASS, 'Listing');
            $row = $sth->fetchAll();
            $sth->closeCursor();
            if (false === $row) {
                return null;
            }
        } catch (PDOException $x) {
            $this->message = $x->getMessage();
            return null;
        }
        return $row;
    }

    public function getSavedListings($email)
    {
        if ($this->dbh === null) {
            return null;
        }
        try {
            $sth = $this->dbh->prepare(/** @lang **/'SELECT * FROM Favorites WHERE User = :email');
            $sth->execute(array(':email' => $email));
            $sth->setFetchMode(PDO::FETCH_GROUP|PDO::FETCH_CLASS, 'Listing');
            $row = $sth->fetchAll();
            $sth->closeCursor();
            if (false === $row) {
                return null;
            }
        } catch (PDOException $x) {
            $this->message = $x->getMessage();
            return null;
        }
        return $row;
    }

    /**
     * @param $category
     * @return null
     */
    public function getUserOfCategory($category)
    {
        if ($this->dbh === null) {
            return null;
        }
        try {
            $sth = $this->dbh->prepare(/** @lang **/'SELECT * FROM Users WHERE Category = :category ORDER BY Name');
            $sth->execute(array(':category' => $category));
            $sth->setFetchMode(PDO::FETCH_GROUP|PDO::FETCH_CLASS, 'User');
            $row = $sth->fetchAll();
            $sth->closeCursor();
            if (false === $row) {
                return null;
            }
        } catch (PDOException $x) {
            $this->message = $x->getMessage();
            return null;
        }
        return $row;
    }


    /**
     * @param string $name
     * @param string $off
     * @return null
     */
    /*
    public function searchName($name = "", $off = "",$guests = "",$type = "",$sort = "",$amenities = "",$price = "",$ratings = "") {
        if ( is_null($this->dbh) ) {
            return null;
        }
        try {
            $name = '%'.$name.'%';
            $off = intval($off);
            $sth = $this->dbh->prepare("SELECT * FROM Listings WHERE Name LIKE ? AND NumOfGuests LIKE ? AND Type LIKE ? AND Amenities LIKE ? AND Price LIKE ? AND Rating LIKE ? LIMIT 10 OFFSET ?");
            $sth->bindParam(1, $name, PDO::PARAM_STR,strlen($name));
            $sth->bindParam(7, $off, PDO::PARAM_INT);

            if ( $guests == 0) {
                $guests = '%';
            } else {
                $guests = strval($guests);
            }

            if ( $type == 0) {
                $type = '%';
            } else {
                $type = strval($type);
            }

            if ( $amenities == '|' || $amenities == '' || $amenities == null) {
                $amenities = '%';
            }

            if ( $price == 0 || $price == 10000) {
                $price = '%';
            } else {
                $price = strval($price);
            }

            if ( $ratings == 0) {
                $ratings = '%';
            } else {
                $ratings = strval($ratings);
            }

            $sth->bindParam(2, $guests, PDO::PARAM_STR,strlen($guests));
            $sth->bindParam(3, $type, PDO::PARAM_STR,strlen($type));
            $sth->bindParam(4, $amenities, PDO::PARAM_STR,strlen($amenities));
            $sth->bindParam(5, $price, PDO::PARAM_STR,strlen($price));
            $sth->bindParam(6, $ratings, PDO::PARAM_STR,strlen($ratings));

            $sth->execute();
            $rows = $sth->fetchAll(PDO::FETCH_CLASS, 'searchclass');
            $sth->closeCursor();
        } catch(PDOException $x) {
                $this->message = $x->getMessage();
                return null;
        }
            return $rows;
    }
*/
    /***************************** Create Functions *****************************/
    /**
     * @param $user
     * @return bool|string|null
     */
    public function createUser($user) {
        if ($this->dbh === null) {
            return 'Error';
        }
        $Hash   = crypt($user['password'], 'BigFeet');
        //NOTE: these are the default values the user can edit them.
        $avatar = '/assets/img/person.png';
        $bio    = 'Hi, I just Started using Bigfeet.';
        $title = ($user['gender'] === 'M') ? 'Mr.' : ($user['gender'] === 'F') ? 'Miss.': 'NA';
        $user_name = $user['name'] . '_' . $user['email'];
        try {
            $sth = $this->dbh->prepare(/** @lang */
                'INSERT INTO Users (Username, Email, Title, Name, Surname, Gender, DOB, Cell, Picture, Bio, Hash, Street, State, City, Postal, Nationality, Category)
                VALUES (:username, :email, :title, :name, :surname, :gender, :dob, :cell, :picture, :bio, :hash, :street, :state, :city, :postal, :nationality, :category)');

            $sth->execute(array(
                ':username' => $user_name,
                ':email' => $user['email'],
                ':title' => $title,
                ':name' => $user['name'],
                ':surname' => $user['surname'],
                ':gender' => $user['gender'],
                ':dob' => $user['dob'],
                ':cell' => $user['cell'],
                ':picture' => $avatar,
                ':bio' => $bio,
                ':hash' => $Hash,
                ':street' => $user['street'],
                ':state' => $user['state'],
                ':city' => $user['city'],
                ':postal' => $user['postal'],
                ':nationality' => $user['nationality'],
                ':category' => $user['category']
            ));
        } catch (PDOException $x) {
            $this->message = $x->getMessage();
            return $this->message;
        }
        return true;
    }

    /**
     * @param $listings
     * @return string|null
     */
    public function createListing($listings) {
        try{
            $sth = $this->dbh->prepare(/** @lang **/'INSERT INTO Listings (Created_At, Host, Name, Type,
            Picture, Price, Amenities, About, Street, State, City, Postal, Nationality,
            Latitude, Longitude, Available, MinLength, NumOfGuests, NumOfRatings, Rating, Availablefrom, Availableuntil,
            Checkintime, Checkouttime) VALUES (:created_at, :host, :name, :type, :pictures, :price, :amenities,
            :about, :street, :state, :city, :postal, :nationality, :latitude, :longitude,
            :available, :minlength, :numofguests, :numofratings, :rating, :availablefrom, :availableuntil, :checkintime,
             :checkouttime)');

            $sth->execute(array(
            ':created_at' => $listings['created_at'],
            ':host' => $listings['host'],
            ':name' => $listings['name'],
            ':type' => $listings['type'],
            ':pictures' => $listings['pictures'],
            ':price' => $listings['price'],
            ':amenities' => $listings['amenities'],
            ':about' => $listings['about'],
            ':street' => $listings['street'],
            ':state' => $listings['state'],
            ':city' => $listings['city'],
            ':postal' => $listings['postal'],
            ':nationality' => $listings['nationality'],
            ':latitude' => $listings['latitude'],
            ':longitude' => $listings['longitude'],
            ':available' => $listings['available'],
            ':minlength' => $listings['minlength'],
            ':numofguests' => $listings['numofguests'],
            ':numofratings' => $listings['numofratings'],
            ':rating' => $listings['rating'],
            ':availablefrom' => $listings['availablefrom'],
            ':availableuntil' => $listings['availableuntil'],
            ':checkintime' => $listings['checkintime'],
            ':checkouttime' => $listings['checkouttime']
            ));
            $id = $this->dbh->lastInsertId();
        } catch(PDOException $x){
            $this->message = $x->getMessage();
            return $this->message;
        }
        return $id;
    }

    public function createBooking($bookings) {
        try{
            $sth = $this->dbh->prepare(/** @lang * */
                'INSERT INTO Bookings (User, Listing, Start_Date, End_Date) VALUES
             (:user, :listing, :start_date, :end_date)');

            $sth->execute(array(
                ':user' => $bookings['user'],
                ':listing' => $bookings['listing'],
                ':start_date' => $bookings['start_date'],
                ':end_date' => $bookings['end_date']
            ));
        } catch(PDOException $x){
            $this->message = $x->getMessage();
            return $this->message;
        }
        return true;
    }
    public function createFavourite($fav) {
        try{
            $sth = $this->dbh->prepare(/** @lang * */
                'INSERT INTO Favorites (User, Listing) VALUES
             (:user, :listing)');

            $sth->execute(array(
                ':user' => $fav['user'],
                ':listing' => $fav['listing'],
            ));
        } catch(PDOException $x){
            $this->message = $x->getMessage();
            return $this->message;
        }
        return true;
    }

    public function createHistory($history) {
        try{
            $sth = $this->dbh->prepare(/** @lang **/'INSERT INTO History (User, Host, Listing, CheckIn, CheckOut) VALUES
             (:guest, :listing, :start_date, :end_date)');

            $sth->execute(array(
                ':user' => $history['guest'],
                ':host' => $history['host'],
                ':listing' => $history['listing'],
                ':start_date' => $history['start_date'],
                ':end_date' => $history['end_date']
            ));
        } catch(PDOException $x){
            $this->message = $x->getMessage();
            return $this->message;
        }
        return true;
    }

    public function createReview($review) {
        if ($this->dbh === null) {
            return 'Error';
        }
        try {
            $sth = $this->dbh->prepare(/** @lang */
                'INSERT INTO Reviews (Guest, Review, Listing, Rating, Picture) VALUES (:guest, :review, :listing, :rating, :picture)');

            $sth->execute(array(
                ':guest' => $review['guest'],
                ':listing' => $review['listing'],
                ':review' => $review['review'],
                ':rating' => $review['rating'],
                ':picture' => $review['picture']
            ));
        } catch (PDOException $x) {
            $this->message = $x->getMessage();
            return false;
        }
        return true;
    }

    /************************* Update Functions *************************/

    /**
     * @param $id
     * @return bool|string
     */
    public function updateViews($id) {
        try{
            $sth = $this->dbh->prepare(/** @lang **/'UPDATE Listings SET Views = Views + :num WHERE ID = :id');

            $sth->execute(array(
                ':num' => 1,
                ':id' => $id
            ));
        } catch(PDOException $x){
            $this->message = $x->getMessage();
            return $this->message;
        }
        return true;
    }




    public function updateListing($listings){
        try{
            $sth = $this->dbh->prepare(/** @lang **/'UPDATE Listings SET Name = :name, Type = :type,
            Picture = :pictures, Price = :price, Amenities = :amenities, About = :about, Street = :street,
            State = :state, City = :city, Postal = :postal, Nationality = :nationality,
            Latitude = :latitude, Longitude = :longitude, Available = :available, MinLength = :minlength)
            WHERE ID=:id');

            $sth->execute(array(
                ':name' => $listings['name'],
                ':type' => $listings['type'],
                ':pictures' => $listings['pictures'],
                ':price' => $listings['price'],
                ':amenities' => $listings['amenities'],
                ':about' => $listings['about'],
                ':street' => $listings['street'],
                ':state' => $listings['state'],
                ':city' => $listings['city'],
                ':postal' => $listings['postal'],
                ':nationality' => $listings['nationality'],
                ':latitude' => $listings['latitude'],
                ':longitude' => $listings['longitude'],
                ':available' => $listings['available'],
                ':minlength' => $listings['minlength'],
                ':id' => $listings['id']
            ));
        } catch(PDOException $x){
            $this->message = $x->getMessage();
            return $this->message;
        }
        return true;
    }

    public function updateBooking($booking){
        try{
            $sth = $this->dbh->prepare(/** @lang **/'UPDATE Bookings SET Name = :name, Type = :type,
            Picture = :pictures, Price = :price, Amenities = :amenities, About = :about, Street = :street,
            State = :state, City = :city, Postal = :postal, Nationality = :nationality,
            Latitude = :latitude, Longitude = :longitude, Available = :available, MinLength = :minlength)');

            $sth->execute(array(
                ':name' => $booking['name'],
                ':type' => $booking['type'],
            ));
        } catch(PDOException $x){
            $this->message = $x->getMessage();
            return $this->message;
        }
        return true;
    }

    /************************* Count Functions *************************/
    /**
     * @param $category
     * @return string
     */
    public function getCategoryCount($category) {
        try{
            $sth = $this->dbh->prepare(/** @lang **/'SELECT count(*) FROM Users WHERE category = :category');

            $sth->execute(array(
                ':category' => $category,
            ));
            $count = $sth->fetchColumn();
            $sth->closeCursor();
        } catch(PDOException $x){
            $this->message = $x->getMessage();
            return $this->message;
        }
        return $count;
    }

    /**
     * @return string
     */
    public function getBookingsCount() {
        try{
            $sth = $this->dbh->prepare(/** @lang **/'SELECT count(*) FROM Bookings');

            $sth->execute();
            $count = $sth->fetchColumn();
            $sth->closeCursor();
        } catch(PDOException $x){
            $this->message = $x->getMessage();
            return $this->message;
        }
        return $count;
    }

    public function getListingsCount() {
        try{
            $sth = $this->dbh->prepare(/** @lang **/'SELECT count(*) FROM Listings');
            $sth->execute();
            $count = $sth->fetchColumn();
            $sth->closeCursor();
        } catch(PDOException $x){
            $this->message = $x->getMessage();
            return $this->message;
        }
        return $count;
    }

    /**
     * @param $start_date
     * @param $end_date
     * @param $listing_id
     * @return bool
     */
    public function checkAvailable($start_date, $end_date, $listing_id) {
        $bookings = $this->getBooking($listing_id);
        $start_time = strtotime($start_date);
        $end_time = strtotime($end_date);
        foreach ($bookings as $booking) {
            if ($start_time >= strtotime($booking->Start_Date) &
                $end_time <= strtotime($booking->End_Date)) {
                return false;
            }
        }
        return true;
    }

    public function backup()
    {
        $sql = 'BACKUP DATABASE BigfeetDB TO DISK = /bigfeetDB.bak';
        try{
            $sth = $this->dbh->prepare(/** @lang **/$sql);
            $sth->execute();
            $sth->closeCursor();
        } catch(PDOException $x){
            $this->message = $x->getMessage();
            return $this->message;
        }
        return true;
    }

    public function getAllListings()
    {
        if ($this->dbh === null) {
            return null;
        }
        try {
            $sth = $this->dbh->prepare(/** @lang * */
                'SELECT * FROM Listings');
            $sth->execute();
            $sth->setFetchMode(PDO::FETCH_GROUP | PDO::FETCH_CLASS, 'Listing');
            $row = $sth->fetchAll();
            $sth->closeCursor();
            if (false === $row) {
                return null;
            }
        } catch (PDOException $x) {
            $this->message = $x->getMessage();
            return null;
        }
        return $row;
    }
    public function getLatestListings() {
        if ($this->dbh === null) {
            return null;
        }
        try {
            $sth = $this->dbh->prepare(/** @lang **/'SELECT * FROM Listings ORDER BY ID DESC LIMIT 0,6');
            $sth->execute();
            $sth->setFetchMode(PDO::FETCH_GROUP|PDO::FETCH_CLASS, 'Listing');
            $row = $sth->fetchAll();
            $sth->closeCursor();
            return ($row === false) ? null : $row;
        } catch (PDOException $x) {
            $this->message = $x->getMessage();
            return null;
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

    public function searchListingId($Id = "") {
        if (is_null($this->dbh)) {
            return null;
        }
        try {
            $sth = $this->dbh->prepare("SELECT * FROM Listings WHERE ID = ? ");
            $Id = intval($Id);
            $sth->bindParam(1, $Id, PDO::PARAM_INT);
            $sth->execute();
            $rows = $sth->fetchAll(PDO::FETCH_CLASS, 'Listing');
            $sth->closeCursor();
        } catch(PDOException $x) {
            $this->message = $x->getMessage();
            return null;
        }
        return $rows;
    }

    public function searchHostId($email = "") {
        if (is_null($this->dbh)) {
            return null;
        }
        try {
            $sth = $this->dbh->prepare("SELECT * FROM Users WHERE Email = ? ");
            $sth->bindParam(1, $email, PDO::PARAM_STR,strlen($email));
            $sth->execute();
            $rows = $sth->fetchAll(PDO::FETCH_CLASS, 'User');
            $sth->closeCursor();
        } catch(PDOException $x) {
            $this->message = $x->getMessage();
            return null;
        }
        return $rows;
    }

    public function getListingReviews($Id = "") {
        if (is_null($this->dbh)) {
            return null;
        }
        try {
            $Id = intval($Id);
            $sth = $this->dbh->prepare("SELECT * FROM Reviews WHERE Listing = ? ");
            $sth->bindParam(1, $Id, PDO::PARAM_INT);
            $sth->execute();
            $rows = $sth->fetchAll(PDO::FETCH_CLASS, 'Review');
            $sth->closeCursor();
        } catch(PDOException $x) {
            $this->message = $x->getMessage();
            return null;
        }
        return $rows;
    }
    public function addUserReview($guest,$listing,$review,$rating,$Picture) {
        if (is_null($this->dbh)) {
            return null;
        }
        try {
            $listing = intval($listing);
            $rating = intval($rating);
            $sth = $this->dbh->prepare("INSERT INTO Reviews (ID, Guest, Listing, Review, Rating, Picture) VALUES (NULL, ?, ?, ?, ?, ?)");
            $sth->bindParam(1, $guest, PDO::PARAM_STR,strlen($guest));
            $sth->bindParam(2, $listing, PDO::PARAM_INT);
            $sth->bindParam(3, $review, PDO::PARAM_STR,strlen($review));
            $sth->bindParam(4, $rating, PDO::PARAM_INT);
            $sth->bindParam(5, $Picture, PDO::PARAM_STR,strlen($Picture));
            $sth->execute();
            //$rows = $sth->fetchAll(PDO::FETCH_CLASS, 'Review');
            $sth->closeCursor();
        } catch(PDOException $x) {
            $this->message = $x->getMessage();
          //  return null;
        }
        //return $rows;
    }


    /************************* Delete Functions *************************/
    /**
     * @param $id
     * @return bool|string
     */
    public function deleteBooking($id) {
        try{
            $sth = $this->dbh->prepare(/** @lang **/'DELETE FROM Bookings WHERE ID = :id');

            $sth->execute(array(
                ':id' => $id,
            ));
            return true;
        } catch(PDOException $x){
            $this->message = $x->getMessage();
            return $this->message;
        }
    }
    /**
     * @param $email
     * @return string
     */
    public function deleteUser($email) {
        try{
            $sth = $this->dbh->prepare(/** @lang **/'DELETE FROM Users WHERE EMAIL = :email');

            $sth->execute(array(
                ':email' => $email,
            ));
            return true;
        } catch(PDOException $x){
            $this->message = $x->getMessage();
            return $this->message;
        }
    }
    public function deleteListing($id) {
        try{
            $sth = $this->dbh->prepare(/** @lang **/'DELETE FROM Listings WHERE ID = :id');

            $sth->execute(array(
                ':id' => $id,
            ));
            return true;
        } catch(PDOException $x){
            $this->message = $x->getMessage();
            return $this->message;
        }
    }

}
