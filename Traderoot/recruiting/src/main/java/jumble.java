public class jumble {

    public static String jumbledString(String s, Long n)
    {
        // convert the float n to an int to index into char array
        int num  = n.intValue();

        /*
        * convert String into char array so that we can deal with each char
        * independently 
        */
        char [] sentence = s.toCharArray();

        // create new char array to store the shifts
        char [] a = new char[s.length()];
        
        /*
        * loop for going through the char array, in order to check 
        * each character
        */
        for (int i = 0; i < sentence.length; i++) {

                // to deal with even indexed chars
                if (i%2 == 0) {
                    if ((num+i) <= s.length()-1) {
                        a[(num%(s.length()-1))+i] = sentence[i];
                    } else {
                        if (num >= sentence.length) {
                            int j = (num+i) % sentence.length;
                            a[j] = sentence[i];
                        } else {
                            int j = i+num;
//                            System.out.println("len(s) is: "+sentence.length+" num is: "+num+" i is: "+ i);
                            a[j-sentence.length] = sentence[i];
                        }
                    }
                // to deal with odd indexed chars   
                } else {
                    if ((i-num) < 0) {
                        if (num <= sentence.length) {
                            a[sentence.length-(num-i)] = sentence[i];
                        } else {
                            int j = (num-i)%sentence.length;
                            a[sentence.length-(j-i)] = sentence[i];
                        }
                    } else {
                        a[(i-num)] = sentence[i];

                    }
                }
        }
        // convert the char array back to a String so that we can return
        String newsentence = new String(a);
        System.out.printf("Result is: %s\n", newsentence);
        return newsentence;
    }

}
