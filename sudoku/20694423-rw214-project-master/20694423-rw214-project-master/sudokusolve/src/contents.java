
import java.io.File;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.Scanner;

public class contents {

    int counter1 = 0;
    String line;
    Scanner sc;
    int sum = 0;
    int nums = 0;
    int empty = 0;
    int rowbox1 = 0;
    int colbox1 = 0;
    int maxR1 = 0;
    int maxC1 = 0;
    String box = "";
    int row = 0;
    int col = 0;
    int rOriginal = 0;
    int colOriginal = 0;
    PrintWriter pw = null;
    int r1 = 0;
    int c1 = 0;
    String file;
    String c;
    private String command = "";
    private String board[][] = new String[9][9];

    public contents() {

    }

    public contents(String sd, String sf) {
/**
 * loads the board contents into a 2 dimensional array 'board' using the specified file name
 * Also loads the command from the specified command file and stores it into a command variable
 */
        file = sd;
        c = sf;

        try {

            sc = new Scanner(new File(file + ".ins"));

            while (sc.hasNextLine()) {

                line = sc.nextLine();

            }
/**
 * adding all the individual numbers into the 2 dimensional array
 */
            for (int i = 0; i < 9; i++) {

                for (int u = 0; u < 9; u++) {

                    board[i][u] = line.charAt(counter1) + "";
                    counter1++;

                }

            }

        } catch (Exception e) {

            System.out.println("An error ocuured");

        }

        try {

            sc = new Scanner(new File(c + ".cf"));

            while (sc.hasNextLine()) {

                command = sc.nextLine();

            }

        } catch (FileNotFoundException e) {

            System.out.println("An error occured");

        }

    }
/**
 * returns the board
 * @return 
 */
    public String[][] getNums() {

        return board;

    }
/**
 * returns the command specified in the command file
 * @return 
 */
    public String getCommands() {

        return command;

    }

    public void display() {
/**
 * algorithm for displaying the board
 */
        
        for (int i = 0; i < 9; i++) {

            if (i % 3 == 0 && i != 0) {

                System.out.println("\n");
            }

            for (int j = 0; j < 9; j++) {

                if (j % 3 == 0 && j != 0) {

                    System.out.printf(String.format("%7s", " "));
                }

                if (Integer.parseInt(board[i][j]) == 0) {

                    System.out.printf(String.format("%7s", "."));

                } else {

                    System.out.printf(String.format("%7s", board[i][j]));

                }

            }

            System.out.print("\n");

        }

    }

    public void ruleoneA() {
/**
 * algorithm rule a
 */
        String[] temp = command.split(" ");

        box = temp[1];
        row = Integer.parseInt(temp[2]);
        col = Integer.parseInt(temp[3]);
        rOriginal = row;
        colOriginal = col;

        if (box.equals("B")) {

            col = col + 3;

        }
        if (box.equals("C")) {

            col = col + 6;

        }

        if (box.equals("D")) {

            row = row + 3;

        }
        if (box.equals("E")) {

            row = row + 3;
            col = col + 3;

        }
        if (box.equals("F")) {

            row = row + 3;
            col = col + 6;

        }
        if (box.equals("G")) {

            row = row + 6;

        }
        if (box.equals("H")) {

            row = row + 6;
            col = col + 3;

        }
        if (box.equals("I")) {

            row = row + 6;
            col = col + 6;

        }
/**
 * checks which numbers are in that specific row
 */
        boolean[] numbers = new boolean[9];

        for (int i = 0; i < 9; i++) {

            if (!board[row][i].equals("0")) {

                numbers[Integer.parseInt(board[row][i]) - 1] = true;

            }

        }

        rowbox1 = 0;
        colbox1 = 0;
        maxR1 = 0;
        maxC1 = 0;

        for (int j = 0; j <= board.length; j++) {

            for (int k = 0; k <= board[0].length; k++) {

                if (j % 3 == 0 && k % 3 == 0) {

                    if ((row >= j && row < j + 3) && (col >= k && col < k + 3)) {

                        rowbox1 = j;
                        colbox1 = k;
                        maxC1 = k + 3;
                        maxR1 = j + 3;

                    }

                }

            }

        }

        r1 = 0;
        c1 = 0;
/**
 * checks which numbers are in the subgrid
 * initializes the boolean array at n-1 to true if n exists in that subgrid
 */
        for (int p = rowbox1; p < maxR1; p++) {

            for (int o = colbox1; o < maxC1; o++) {

                if (!board[p][o].equals("0")) {

                    numbers[Integer.parseInt(board[p][o]) - 1] = true;

                }

            }

        }
        for (int i = 0; i < 9; i++) {

            if (!board[i][col].equals("0")) {

                numbers[Integer.parseInt(board[i][col]) - 1] = true;

            }

        }
/**
 * checks how many numbers are not in the different groups
 */
        int howmany = 0;
        int ii = 0;

        for (int i = 0; i < numbers.length; i++) {

            if (numbers[i] == false) {

                ii = i;
                howmany++;

            }

        }

        if (howmany == 1) {

            board[row][col] = (ii + 1) + "";

        }

        try {
/**
 * prints the output into a text file
 */
            pw = new PrintWriter(c + ".out");

            if (!(board[row][col].equals("0"))) {

                pw.write(box + rOriginal + colOriginal + "+" + (board[row][col]));

            } else {

                pw.write("");

            }

            pw.close();

        } catch (FileNotFoundException ex) {

            System.out.println("An error occured");

        }

    }

    public void ruleoneB() {
/**
 * algorithm for rule b
 */
        String[] temp = command.split(" ");

        box = temp[1];
        row = Integer.parseInt(temp[2]);
        col = Integer.parseInt(temp[3]);
        rOriginal = row;
        colOriginal = col;

        if (box.equals("B")) {

            col = col + 3;

        }
        if (box.equals("C")) {

            col = col + 6;

        }

        if (box.equals("D")) {

            row = row + 3;

        }
        if (box.equals("E")) {

            row = row + 3;
            col = col + 3;

        }
        if (box.equals("F")) {

            row = row + 3;
            col = col + 6;

        }
        if (box.equals("G")) {

            row = row + 6;

        }
        if (box.equals("H")) {

            row = row + 6;
            col = col + 3;

        }
        if (box.equals("I")) {

            row = row + 6;
            col = col + 6;

        }

        boolean found = false;

        nums = 0;
        sum = 0;

        for (int i = 0; i < 9; i++) {

            sum += Integer.parseInt(board[row][i]);

            if (board[row][i].equals("0")) {

                empty = i;

            } else {

                nums++;

            }

        }

        if (nums == 8) {

            board[row][empty] = (45 - sum) + "";
            found = true;

        }

        if (found == false) {

            rowbox1 = 0;
            colbox1 = 0;
            maxR1 = 0;
            maxC1 = 0;

            for (int j = 0; j <= board.length; j++) {

                for (int k = 0; k <= board[0].length; k++) {

                    if (j % 3 == 0 && k % 3 == 0) {

                        if ((row >= j && row < j + 3) && (col >= k && col < k + 3)) {

                            rowbox1 = j;
                            colbox1 = k;
                            maxC1 = k + 3;
                            maxR1 = j + 3;

                        }

                    }

                }

            }

            r1 = 0;
            c1 = 0;
            nums = 0;
            sum = 0;

            for (int p = rowbox1; p < maxR1; p++) {

                for (int o = colbox1; o < maxC1; o++) {

                    sum += Integer.parseInt(board[p][o]);

                    if (board[p][o].equals("0")) {

                        r1 = p;
                        c1 = o;

                    } else {

                        nums++;

                    }

                }

            }
            if (nums == 8) {

                board[r1][c1] = (45 - sum) + "";
                found = true;

            }

        }

        if (found == false) {

            sum = 0;
            empty = 0;
            nums = 0;

            for (int i = 0; i < 9; i++) {

                sum += Integer.parseInt(board[i][col]);

                if (board[i][col].equals("0")) {

                    empty = i;

                } else {

                    nums++;

                }

            }

            if (nums == 8) {

                board[empty][col] = (45 - sum) + "";

            }

        }

        try {

            pw = new PrintWriter(c + ".out");

            if (!(board[row][col].equals("0"))) {

                pw.write(box + rOriginal + colOriginal + "+" + (board[row][col]));

            } else {

                pw.write("");

            }
            pw.close();

        } catch (FileNotFoundException ex) {

            System.out.println("An error occured");

        }

    }

    public void ruletwoA() {
/**
 * algorithm for rule 2a
 */
        String[] temp = command.split(" ");
        box = temp[1];
        row = Integer.parseInt(temp[2]);
        col = Integer.parseInt(temp[3]);
        int num = Integer.parseInt(temp[4]);

        if (box.equals("B")) {

            col = col + 3;

        }
        if (box.equals("C")) {

            col = col + 6;

        }

        if (box.equals("D")) {

            row = row + 3;

        }
        if (box.equals("E")) {

            row = row + 3;
            col = col + 3;

        }
        if (box.equals("F")) {

            row = row + 3;
            col = col + 6;

        }
        if (box.equals("G")) {

            row = row + 6;

        }
        if (box.equals("H")) {

            row = row + 6;
            col = col + 3;

        }
        if (box.equals("I")) {

            row = row + 6;
            col = col + 6;

        }

        rowbox1 = 0;
        colbox1 = 0;
        maxR1 = 0;
        maxC1 = 0;

        for (int j = 0; j <= board.length; j++) {

            for (int k = 0; k <= board[0].length; k++) {

                if (j % 3 == 0 && k % 3 == 0) {

                    if ((row >= j && row < j + 3) && (col >= k && col < k + 3)) {

                        rowbox1 = j;
                        colbox1 = k;
                        maxC1 = k + 3;
                        maxR1 = j + 3;

                    }

                }

            }

        }
        int rGo = 0;
        int cGo = 0;
        int rowcount = 0;
        int colcount = 0;
        boolean validR = false;
        boolean validC = false;
/**
 * counts the number of empty cells in the row
 */
        for (int i = colbox1; i < maxC1; i++) {

            if (board[row][i].equals("0")) {

                colcount++;

            }

        }

        if (colcount == 3) {

            validR = true;

        }

        if (validR == false) {
/**
 * counts the number of empty cells in rows in that specifc column
 */
            for (int i = rowbox1; i < maxR1; i++) {

                if (board[i][col].equals("0")) {

                    rowcount++;

                }

            }

            if (rowcount == 3) {

                validC = true;

            }

        }
        String region = "";
        String o = "";

        if (validR == true) {

            for (int y = 0; y < 9; y++) {

                if (!(y < maxC1 && y >= colbox1)) {

                    if (board[row][y].equals("0") && check(row, y, num) == true) {

                        if (y >= 0 && y <= 2) {

                            if (row >= 0 && row <= 2) {

                                region = "A";

                            }

                            if (row >= 3 && row <= 5) {

                                region = "D";

                            }
                            if (row >= 6 && row <= 8) {

                                region = "G";

                            }

                        }
                        if (y >= 3 && y <= 5) {

                            if (row >= 0 && row <= 2) {

                                region = "B";

                            }

                            if (row >= 3 && row <= 5) {

                                region = "E";

                            }
                            if (row >= 6 && row <= 8) {

                                region = "H";

                            }

                        }
                        if (y >= 6 && y <= 8) {

                            if (row >= 0 && row <= 2) {

                                region = "C";

                            }

                            if (row >= 3 && row <= 5) {

                                region = "F";

                            }
                            if (row >= 6 && row <= 8) {

                                region = "I";

                            }

                        }

                        o = o + region + (row % 3) + (y % 3) + "-" + num + "\n";

                    }

                }
            }
        } else if (validC == true) {

            for (int y = 0; y < 9; y++) {

                if ((y < rowbox1 || y >= maxR1)) {

                    if (board[y][col].equals("0") && (check(y, col, num) == true)) {
/**
 * gets the subgrid letter based on the row and column
 */
                        
                        if (col >= 0 && col <= 2) {

                            if (y >= 0 && y <= 2) {

                                region = "A";

                            }

                            if (y >= 3 && y <= 5) {

                                region = "D";

                            }
                            if (y >= 6 && y <= 8) {

                                region = "G";

                            }

                        }
                        if (col >= 3 && col <= 5) {

                            if (y >= 0 && y <= 2) {

                                region = "B";

                            }

                            if (y >= 3 && y <= 5) {

                                region = "E";

                            }
                            if (y >= 6 && y <= 8) {

                                region = "H";

                            }

                        }
                        if (col >= 6 && col <= 8) {

                            if (y >= 0 && y <= 2) {

                                region = "C";

                            }

                            if (y >= 3 && y <= 5) {

                                region = "F";

                            }
                            if (y >= 6 && y <= 8) {

                                region = "I";

                            }

                        }

                        o = o + region + (y % 3) + (col % 3) + "-" + num + "\n";

                    }

                }
            }

        }

        try {

            pw = new PrintWriter(c + ".out");
            pw.printf(o);
            pw.close();

        } catch (FileNotFoundException ex) {

            System.out.println("An error occured");

        }

    }

    public void ruletwoB() {
/**
 * algorithm fo rrule 2b
 */
        String[] temp = command.split(" ");
        box = temp[1];
        row = Integer.parseInt(temp[2]);
        col = Integer.parseInt(temp[3]);
        int num = Integer.parseInt(temp[4]);

        if (box.equals("B")) {

            col = col + 3;

        }
        if (box.equals("C")) {

            col = col + 6;

        }

        if (box.equals("D")) {

            row = row + 3;

        }
        if (box.equals("E")) {

            row = row + 3;
            col = col + 3;

        }
        if (box.equals("F")) {

            row = row + 3;
            col = col + 6;

        }
        if (box.equals("G")) {

            row = row + 6;

        }
        if (box.equals("H")) {

            row = row + 6;
            col = col + 3;

        }
        if (box.equals("I")) {

            row = row + 6;
            col = col + 6;

        }

        rowbox1 = 0;
        colbox1 = 0;
        maxR1 = 0;
        maxC1 = 0;
        out:
        for (int j = 0; j <= board.length; j++) {

            for (int k = 0; k <= board[0].length; k++) {

                if (j % 3 == 0 && k % 3 == 0) {

                    if ((row >= j && row < j + 3) && (col >= k && col < k + 3)) {

                        rowbox1 = j;
                        colbox1 = k;
                        maxC1 = k + 3;
                        maxR1 = j + 3;
                        break out;
                    }

                }

            }

        }

        int colcount = 0;
        int rowcount = 0;
        boolean validR = false;
        boolean validC = false;

        for (int i = colbox1; i < maxC1; i++) {

            if (board[row][i].equals("0") && check(row, i, num) == true) {

                colcount++;

            }

        }

        if (colcount > 1) {

            validR = true;

        }

        for (int i = rowbox1; i < maxR1; i++) {

            if (board[i][col].equals("0") && check(i, col, num)) {

                rowcount++;

            }

        }

        if (rowcount > 1) {

            validC = true;

        }

        String o = "";

        if (validR == true && validC == false) {

            for (int i = rowbox1; i < maxR1; i++) {

                for (int j = colbox1; j < maxC1; j++) {

                    if (i != row && board[i][j].equals("0") && check(i, j, num) == true) {

                        o = o + box + (i % 3) + (j % 3) + "-" + num + "\n";

                    }

                }

            }

        } else if (validC == true && validR == false) {

            for (int i = rowbox1; i < maxR1; i++) {

                for (int j = colbox1; j < maxC1; j++) {

                    if (j != col && board[i][j].equals("0") && check(i, j, num) == true) {

                        o = o + box + (i % 3) + (j % 3) + "-" + num + "\n";

                    }

                }

            }

        } else if (validR == true && validC == true) {

            if (colcount > rowcount) {

                for (int i = rowbox1; i < maxR1; i++) {

                    for (int j = colbox1; j < maxC1; j++) {

                        if (i != row && board[i][j].equals("0") && check(i, j, num) == true) {

                            o = o + box + (i % 3) + (j % 3) + "-" + num + "\n";

                        }

                    }

                }

            } else if (row > colcount) {

                for (int i = rowbox1; i < maxR1; i++) {

                    for (int j = colbox1; j < maxC1; j++) {

                        if (j != col && board[i][j].equals("0") && check(i, j, num) == true) {

                            o = o + box + (i % 3) + (j % 3) + "-" + num + "\n";

                        }

                    }

                }

            } else if (rowcount == colcount) {

                for (int i = rowbox1; i < maxR1; i++) {

                    for (int j = colbox1; j < maxC1; j++) {

                        if (i != row && board[i][j].equals("0") && check(i, j, num) == true) {

                            o = o + box + (i % 3) + (j % 3) + "-" + num + "\n";

                        }

                    }

                }

            }

        }

        try {

            pw = new PrintWriter(c + ".out");

            pw.printf(o);

            pw.close();

        } catch (IOException ex) {

            System.out.println("An error occured");

        }

    }

    public void rulethree() {
/**
 * algorithm for rule 3
 */
        String nums = "";
        int countnums = 0;

        String[] temp = command.split(" ");

        box = temp[1];
        row = Integer.parseInt(temp[2]);
        col = Integer.parseInt(temp[3]);
        rOriginal = row;
        colOriginal = col;

        if (box.equals("B")) {

            col = col + 3;

        }
        if (box.equals("C")) {

            col = col + 6;

        }

        if (box.equals("D")) {

            row = row + 3;

        }
        if (box.equals("E")) {

            row = row + 3;
            col = col + 3;

        }
        if (box.equals("F")) {

            row = row + 3;
            col = col + 6;

        }

        if (box.equals("G")) {

            row = row + 6;

        }

        if (box.equals("H")) {

            row = row + 6;
            col = col + 3;

        }

        if (box.equals("I")) {

            row = row + 6;
            col = col + 6;

        }
/**
 * gets the subgrid boundaries
 */
        out:
        for (int j = 0; j <= board.length; j++) {

            for (int k = 0; k <= board[0].length; k++) {

                if (j % 3 == 0 && k % 3 == 0) {

                    if ((row >= j && row < j + 3) && (col >= k && col < k + 3)) {

                        rowbox1 = j;
                        colbox1 = k;
                        maxC1 = k + 3;
                        maxR1 = j + 3;
                        break out;

                    }

                }

            }

        }
        outerLoop:
        for (int i = 1; i <= 9; i++) {

            if (countnums < 2) {

                boolean found = false;

                boxLoop:
                for (int rw = rowbox1; rw < maxR1; rw++) {

                    for (int cl = colbox1; cl < maxC1; cl++) {

                        if (Integer.parseInt(board[rw][cl]) == i) {

                            found = true;
                            break boxLoop;

                        }

                    }

                }

                if (found == false) {

                    for (int y = 0; y < 9; y++) {

                        if (Integer.parseInt(board[row][y]) == i) {

                            found = true;

                            break;

                        }

                    }
                }

                if (found == false) {

                    for (int z = 0; z < 9; z++) {

                        if (Integer.parseInt(board[z][col]) == i) {

                            found = true;

                            break;

                        }

                    }

                }

                if (found == false) {

                    nums = nums + "" + i;
                    countnums++;

                }
            }

        }

        String[] s = nums.split("");
        int num1 = Integer.parseInt(s[0]);
        int num2 = Integer.parseInt(s[1]);
        String rPos = "";
        String cPos = "";
        String rPos2 = "";
        String cPos2 = "";
        boolean valid = true;

        try {

            pw = new PrintWriter(c + ".out");

            Checkcells:
            for (int rwC = rowbox1; rwC < maxR1; rwC++) {

                for (int clC = colbox1; clC < maxC1; clC++) {

                    valid = true;

                    if (rwC != row || clC != col) {

                        boxLoop:
                        for (int rw = rowbox1; rw < maxR1; rw++) {

                            for (int cl = colbox1; cl < maxC1; cl++) {

                                if ((Integer.parseInt(board[rw][cl]) == num1 || Integer.parseInt(board[rw][cl]) == num2)) {

                                    valid = false;
                                    break boxLoop;
                                }

                            }

                        }

                        if (valid == true) {

                            for (int y = 0; y < 9; y++) {

                                if ((Integer.parseInt(board[rwC][y]) == num1 || Integer.parseInt(board[rwC][y]) == num2)) {

                                    valid = false;

                                    break;

                                }

                            }

                        }

                        if (valid == true) {

                            for (int x = 0; x < 9; x++) {

                                if ((Integer.parseInt(board[x][clC]) == num1 || Integer.parseInt(board[x][clC]) == num2)) {

                                    valid = false;

                                    break;

                                }

                            }
                        }

                        if (valid == true) {

                            rPos = rwC + "";
                            cPos = clC + "";
                            break Checkcells;

                        }

                    }

                }

            }

            if (valid == false) {

                valid = true;

                loop:
                for (int a = 0; a < 9; a++) {

                    for (int g = 0; g < 9; g++) {

                        if (g != col && (Integer.parseInt(board[row][g]) == num1 || Integer.parseInt(board[row][g]) == num2)) {

                            valid = false;

                        }

                    }

                    if (valid == true) {

                        for (int b = 0; b < 9; b++) {

                            if (b != row) {

                                if (Integer.parseInt(board[b][a]) == num1 || Integer.parseInt(board[b][a]) == num2) {

                                    valid = false;

                                }

                            }

                        }

                    }

                    if (valid == true) {

                        rowbox1 = 0;
                        colbox1 = 0;
                        maxR1 = 0;
                        maxC1 = 0;
                        out:
                        for (int j = 0; j <= board.length; j++) {

                            for (int k = 0; k <= board[0].length; k++) {

                                if (j % 3 == 0 && k % 3 == 0) {

                                    if ((row >= j && row < j + 3) && (a >= k && a < k + 3)) {

                                        rowbox1 = j;
                                        colbox1 = k;
                                        maxC1 = k + 3;
                                        maxR1 = j + 3;
                                        break out;
                                    }

                                }

                            }

                        }

                        boxLoop:
                        for (int rw = rowbox1; rw < maxR1; rw++) {

                            for (int cl = colbox1; cl < maxC1; cl++) {

                                if (Integer.parseInt(board[rw][cl]) == num1 || Integer.parseInt(board[rw][cl]) == num2) {
                                    valid = false;
                                    break boxLoop;

                                }

                            }

                        }

                        if (valid == true) {

                            rPos = row + "";
                            cPos = a + "";
                            break loop;

                        }

                    }

                }

            }

            if (valid == false) {

                loop2:
                for (int a = 0; a < 9; a++) {

                    if (a != row) {

                        for (int g = 0; g < 9; g++) {

                            if ((Integer.parseInt(board[g][col]) == num1 || Integer.parseInt(board[g][col]) == num2)) {

                                valid = false;

                            }

                        }

                        if (valid == true) {

                            for (int b = 0; b < 9; b++) {

                                if (b != col) {

                                    if (Integer.parseInt(board[a][b]) == num1 || Integer.parseInt(board[a][b]) == num2) {

                                        valid = false;

                                    }

                                }

                            }

                        }

                        if (valid == true) {

                            rowbox1 = 0;
                            colbox1 = 0;
                            maxR1 = 0;
                            maxC1 = 0;
                            out:
                            for (int j = 0; j <= board.length; j++) {

                                for (int k = 0; k <= board[0].length; k++) {

                                    if (j % 3 == 0 && k % 3 == 0) {

                                        if ((row >= j && row < j + 3) && (a >= k && a < k + 3)) {

                                            rowbox1 = j;
                                            colbox1 = k;
                                            maxC1 = k + 3;
                                            maxR1 = j + 3;
                                            break out;
                                        }

                                    }

                                }

                            }

                            boxLoop:
                            for (int rw = rowbox1; rw < maxR1; rw++) {

                                for (int cl = colbox1; cl < maxC1; cl++) {

                                    if (Integer.parseInt(board[rw][cl]) == num1 || Integer.parseInt(board[rw][cl]) == num2) {
                                        valid = false;
                                        break boxLoop;

                                    }

                                }

                            }

                            if (valid == true) {

                                rPos = a + "";
                                cPos = col + "";
                                break loop2;

                            }

                        }

                    }

                }

            }

            boolean presentnums[] = new boolean[9];
            String region = "";

            rowbox1 = 0;
            colbox1 = 0;
            maxR1 = 0;
            maxC1 = 0;
            out:
            for (int j = 0; j <= board.length; j++) {

                for (int k = 0; k <= board[0].length; k++) {

                    if (j % 3 == 0 && k % 3 == 0) {

                        if ((row >= j && row < j + 3) && (col >= k && col < k + 3)) {

                            rowbox1 = j;
                            colbox1 = k;
                            maxC1 = k + 3;
                            maxR1 = j + 3;
                            break out;
                        }

                    }

                }

            }

            for (int rw = rowbox1; rw < maxR1; rw++) {

                for (int cl = colbox1; cl < maxC1; cl++) {

                    if (!board[rw][cl].equals("0")) {

                        presentnums[Integer.parseInt(board[rw][cl]) - 1] = true;

                    }

                }

            }

            for (int i = 0; i < 9; i++) {

                if (!board[row][i].equals("0")) {

                    presentnums[Integer.parseInt(board[row][i]) - 1] = true;

                }

            }
            for (int i = 0; i < 9; i++) {

                if (!board[i][col].equals("0")) {

                    presentnums[Integer.parseInt(board[i][col]) - 1] = true;

                }

            }

            boolean presentnums2[] = new boolean[9];

            rowbox1 = 0;
            colbox1 = 0;
            maxR1 = 0;
            maxC1 = 0;
            out:
            for (int j = 0; j <= board.length; j++) {

                for (int k = 0; k <= board[0].length; k++) {

                    if (j % 3 == 0 && k % 3 == 0) {

                        if ((Integer.parseInt(rPos) >= j && Integer.parseInt(rPos) < j + 3) && (Integer.parseInt(cPos) >= k && Integer.parseInt(cPos) < k + 3)) {

                            rowbox1 = j;
                            colbox1 = k;
                            maxC1 = k + 3;
                            maxR1 = j + 3;
                            break out;
                        }

                    }

                }

            }

            for (int rw = rowbox1; rw < maxR1; rw++) {

                for (int cl = colbox1; cl < maxC1; cl++) {

                    if (!board[rw][cl].equals("0")) {

                        presentnums2[Integer.parseInt(board[rw][cl]) - 1] = true;

                    }

                }

            }

            for (int i = 0; i < 9; i++) {

                if (!board[Integer.parseInt(rPos)][i].equals("0")) {

                    presentnums2[Integer.parseInt(board[Integer.parseInt(rPos)][i]) - 1] = true;

                }

            }
            for (int i = 0; i < 9; i++) {

                if (!board[i][Integer.parseInt(cPos)].equals("0")) {

                    presentnums2[Integer.parseInt(board[i][Integer.parseInt(cPos)]) - 1] = true;
                }

            }
/**
 * calculates the subgrid letter for the specific cell with row rPos and column cPos
 */
            if (Integer.parseInt(cPos) >= 0 && Integer.parseInt(cPos) <= 2) {

                if (Integer.parseInt(rPos) >= 0 && Integer.parseInt(rPos) <= 2) {

                    region = "A";

                }

                if (Integer.parseInt(rPos) >= 3 && Integer.parseInt(rPos) <= 5) {

                    region = "D";

                }
                if (Integer.parseInt(rPos) >= 6 && Integer.parseInt(rPos) <= 8) {

                    region = "G";

                }

            }
            if (Integer.parseInt(cPos) >= 3 && Integer.parseInt(cPos) <= 5) {

                if (Integer.parseInt(rPos) >= 0 && Integer.parseInt(rPos) <= 2) {

                    region = "B";

                }

                if (Integer.parseInt(rPos) >= 3 && Integer.parseInt(rPos) <= 5) {

                    region = "E";

                }
                if (Integer.parseInt(rPos) >= 6 && Integer.parseInt(rPos) <= 8) {

                    region = "H";

                }

            }
            if (Integer.parseInt(cPos) >= 6 && Integer.parseInt(cPos) <= 8) {

                if (Integer.parseInt(rPos) >= 0 && Integer.parseInt(rPos) <= 2) {

                    region = "C";

                }

                if (Integer.parseInt(rPos) >= 3 && Integer.parseInt(rPos) <= 5) {

                    region = "F";

                }
                if (Integer.parseInt(rPos) >= 6 && Integer.parseInt(rPos) <= 8) {

                    region = "I";

                }

            }
            String printme = "";
            presentnums[num1 - 1] = true;
            presentnums[num2 - 1] = true;
            presentnums2[num1 - 1] = true;
            presentnums2[num2 - 1] = true;

            for (int i = 0; i < presentnums2.length; i++) {

                if (presentnums[i] == false) {

                    printme = printme + box + "" + (row % 3) + "" + (col % 3) + "-" + (i + 1) + "\n";

                }
            }
            for (int i = 0; i < presentnums.length; i++) {

                if (presentnums2[i] == false) {

                    printme = printme + region + "" + (Integer.parseInt(rPos) % 3) + "" + (Integer.parseInt(cPos) % 3) + "-" + (i + 1) + "\n";

                }
            }

            if (printme.length() > 3) {

                pw.printf(printme);

            } else {

                System.out.println("Cannot be solved!");

            }

            pw.close();

        } catch (IOException ex) {

            System.out.println("An error occured");

        }

    }

    public void rulefourA() {
/**
 * algorithm for rule 4a
 */
        String[] temp = command.split(" ");

        box = temp[1];
        row = Integer.parseInt(temp[2]);
        col = Integer.parseInt(temp[3]);
        int num = Integer.parseInt(temp[4]);

        try {

            pw = new PrintWriter(c + ".out");

            if (box.equals("B")) {

                col = col + 3;

            }
            if (box.equals("C")) {

                col = col + 6;

            }

            if (box.equals("D")) {

                row = row + 3;

            }
            if (box.equals("E")) {

                row = row + 3;
                col = col + 3;

            }
            if (box.equals("F")) {

                row = row + 3;
                col = col + 6;

            }

            if (box.equals("G")) {

                row = row + 6;

            }

            if (box.equals("H")) {

                row = row + 6;
                col = col + 3;

            }

            if (box.equals("I")) {

                row = row + 6;
                col = col + 6;

            }

            boolean checkme = true;

            for (int e = 0; e < 9; e++) {

                if (board[e][col].equals(num + "")) {

                    checkme = false;
                    break;
                }

            }

            if (checkme == true) {

                for (int y = 0; y < 9; y++) {

                    if (board[row][y].equals(num + "")) {

                        checkme = false;
                        break;
                    }

                }

            }

            if (checkme == true) {
/**
 * adds and edge from row to column if number i is valid for that specific cell
 */
                Graph g = new Graph(18);

                for (int i = 0; i < 9; i++) {

                    for (int j = 0; j < 9; j++) {

                        if (board[i][j].equals("0")) {

                            if (check(i, j, num) == true) {

                                g.addEdge(i, j + 9);
                            }
                        }

                    }

                }

                boolean fits = true;
/**
 * checks the degree for each vertex in graph g from vertex 0 to 8
 */
                for (int u = 0; u < 9; u++) {

                    if (degree(g, u) != 1) {

                        fits = false;
                        break;

                    }

                }

                if (fits == false) {

                    try {

                        pw.write(box + (row % 3) + (col % 3) + "-" + num);

                        pw.close();

                    } catch (Exception ex) {

                        System.out.println("An error occured");

                    }

                } else {

                    try {

                        pw.write("");

                        pw.close();

                    } catch (Exception ex) {

                        System.out.println("An error occured");

                    }

                }

            } else {

                pw.write("");

                pw.close();

            }

        } catch (IOException ex) {

            System.out.println("An error occured");

        }
    }

    public void ruletwoC() {
/** 
 * algorithm for rule 2c
 */
        String[] temp = command.split(" ");
        box = temp[1];
        row = Integer.parseInt(temp[2]);
        col = Integer.parseInt(temp[3]);

        try {

            pw = new PrintWriter(c + ".out");

            if (box.equals("B")) {

                col = col + 3;

            }
            if (box.equals("C")) {

                col = col + 6;

            }

            if (box.equals("D")) {

                row = row + 3;

            }
            if (box.equals("E")) {

                row = row + 3;
                col = col + 3;

            }
            if (box.equals("F")) {

                row = row + 3;
                col = col + 6;

            }
            if (box.equals("G")) {

                row = row + 6;

            }
            if (box.equals("H")) {

                row = row + 6;
                col = col + 3;

            }
            if (box.equals("I")) {

                row = row + 6;
                col = col + 6;

            }

            rowbox1 = 0;
            colbox1 = 0;
            maxR1 = 0;
            maxC1 = 0;
            out:
            for (int j = 0; j <= board.length; j++) {

                for (int k = 0; k <= board[0].length; k++) {

                    if (j % 3 == 0 && k % 3 == 0) {

                        if ((row >= j && row < j + 3) && (col >= k && col < k + 3)) {

                            rowbox1 = j;
                            colbox1 = k;
                            maxC1 = k + 3;
                            maxR1 = j + 3;
                            break out;
                        }

                    }

                }

            }
            int colcount = 0;
            int rowcount = 0;
            boolean validR = false;
            boolean validC = false;
/**
 * checks if theres 3 consecutive empty cells
 */
            for (int i = colbox1; i < maxC1; i++) {

                if (board[row][i].equals("0")) {

                    colcount++;

                }

            }

            if (colcount == 3) {

                validR = true;

            }

            if (validR == false) {

                for (int i = rowbox1; i < maxR1; i++) {

                    if (board[i][col].equals("0")) {

                        rowcount++;

                    }

                }

                if (rowcount == 3) {

                    validC = true;

                }

            }
            String o = "";

            if (validR == true && validC == false) {

                int cc = 0;

                for (int i = colbox1; i < maxC1; i++) {

                    for (int j = 0; j < 9; j++) {

                        if (!(board[j][i].equals("0")) && i != col) {

                            cc++;

                        }

                    }

                }
                for (int i = rowbox1; i < maxR1; i++) {

                    for (int j = 0; j < 9; j++) {

                        if (!(board[i][j].equals("0")) && i != row) {

                            cc++;

                        }

                    }

                }

                int numslist[] = new int[cc];
                int counter = 0;

                for (int i = colbox1; i < maxC1; i++) {

                    for (int j = 0; j < 9; j++) {

                        if (!(board[j][i].equals("0")) && i != col) {

                            numslist[counter] = Integer.parseInt(board[j][i]);
                            counter++;

                        }

                    }

                }

                for (int i = rowbox1; i < maxR1; i++) {

                    for (int j = 0; j < 9; j++) {

                        if (!(board[i][j].equals("0")) && i != row) {

                            numslist[counter] = Integer.parseInt(board[i][j]);
                            counter++;
                        }

                    }

                }

                for (int i = colbox1; i < maxC1; i++) {

                    for (int p = 1; p <= 9; p++) {

                        boolean found = true;

                        for (int l = 0; l < numslist.length; l++) {

                            if (p == numslist[l]) {

                                found = false;
                                break;

                            }

                        }

                        if (found == true) {

                            o = o + (box + (row % 3) + (i % 3) + "-" + p) + "\n";

                        }

                    }

                }

            } else if (validC = true && validR == false) {

                int cc = 0;

                for (int i = rowbox1; i < maxR1; i++) {

                    for (int j = 0; j < 9; j++) {

                        if (!(board[i][j].equals("0")) && i != row) {

                            cc++;

                        }

                    }

                }
                for (int i = colbox1; i < maxC1; i++) {

                    for (int j = 0; j < 9; j++) {

                        if (!(board[j][i].equals("0")) && i != col) {

                            cc++;

                        }

                    }

                }

                int numslist[] = new int[cc];
                int counter = 0;

                for (int i = rowbox1; i < maxR1; i++) {

                    for (int j = 0; j < 9; j++) {

                        if (!(board[i][j].equals("0")) && i != row) {

                            numslist[counter] = Integer.parseInt(board[i][j]);
                            counter++;

                        }

                    }
                }
                for (int i = colbox1; i < maxC1; i++) {

                    for (int j = 0; j < 9; j++) {

                        if (!(board[j][i].equals("0")) && i != col) {

                            numslist[counter] = Integer.parseInt(board[j][i]);
                            counter++;

                        }

                    }
                }

                for (int i = rowbox1; i < maxR1; i++) {

                    for (int p = 1; p <= 9; p++) {

                        boolean found = true;

                        for (int l = 0; l < numslist.length; l++) {

                            if (p == numslist[l]) {

                                found = false;
                                break;

                            }

                        }

                        if (found == true) {

                            o = o + box + (i % 3) + (col % 3) + "-" + p + "\n";

                        }

                    }

                }

            } else if (validR == true && validC == true) {

                int cc = 0;

                for (int i = colbox1; i < maxC1; i++) {

                    for (int j = 0; j < 9; j++) {

                        if (!(board[j][i].equals("0")) && i != col) {

                            cc++;

                        }

                    }

                }
                for (int i = rowbox1; i < maxR1; i++) {

                    for (int j = 0; j < 9; j++) {

                        if (!(board[i][j].equals("0")) && i != row) {

                            cc++;

                        }

                    }

                }

                int numslist[] = new int[cc];
                int counter = 0;

                for (int i = colbox1; i < maxC1; i++) {

                    for (int j = 0; j < 9; j++) {

                        if (!(board[j][i].equals("0")) && i != col) {

                            numslist[counter] = Integer.parseInt(board[j][i]);
                            counter++;

                        }

                    }

                }

                for (int i = rowbox1; i < maxR1; i++) {

                    for (int j = 0; j < 9; j++) {

                        if (!(board[i][j].equals("0")) && i != row) {

                            numslist[counter] = Integer.parseInt(board[i][j]);
                            counter++;
                        }

                    }

                }

                for (int i = colbox1; i < maxC1; i++) {

                    for (int p = 1; p <= 9; p++) {

                        boolean found = true;

                        for (int l = 0; l < numslist.length; l++) {

                            if (p == numslist[l]) {

                                found = false;
                                break;

                            }

                        }

                        if (found == true) {

                            o = o + (box + (row % 3) + (i % 3) + "-" + p) + "\n";

                        }

                    }

                }

            }

            pw.printf(o);

            pw.close();

        } catch (IOException ex) {

            System.out.println("An error occured");

        }

    }

    public void rulefourB() {
/**
 * algorithm for rule 4b
 */
        String[] temp = command.split(" ");

        box = temp[1];
        row = Integer.parseInt(temp[2]);
        col = Integer.parseInt(temp[3]);
        int num = Integer.parseInt(temp[4]);

        if (box.equals("B")) {

            col = col + 3;

        }
        if (box.equals("C")) {

            col = col + 6;

        }

        if (box.equals("D")) {

            row = row + 3;

        }
        if (box.equals("E")) {

            row = row + 3;
            col = col + 3;

        }
        if (box.equals("F")) {

            row = row + 3;
            col = col + 6;

        }

        if (box.equals("G")) {

            row = row + 6;

        }

        if (box.equals("H")) {

            row = row + 6;
            col = col + 3;

        }

        if (box.equals("I")) {

            row = row + 6;
            col = col + 6;

        }
/**
 * gets subgrid boundaries for the selected cell
 */
        rowbox1 = 0;
        colbox1 = 0;
        maxR1 = 0;
        maxC1 = 0;
        out:
        for (int j = 0; j <= board.length; j++) {

            for (int k = 0; k <= board[0].length; k++) {

                if (j % 3 == 0 && k % 3 == 0) {

                    if ((row >= j && row < j + 3) && (col >= k && col < k + 3)) {

                        rowbox1 = j;
                        colbox1 = k;
                        maxC1 = k + 3;
                        maxR1 = j + 3;
                        break out;
                    }

                }

            }

        }

        if (check(row, col, num) == true) {

            Graph g1 = new Graph(18);
            Graph g2 = new Graph(18);
            Graph g3 = new Graph(18);

/**
 * adds an edge to digit and row or digit and column ro digit and sugbgrid
 */
            for (int i = 1; i <= 9; i++) {

                for (int j = 0; j < 9; j++) {

                    if (board[row][j].equals("0") && check(row, j, i) == true) {

                        g1.addEdge(i - 1, j + 9);

                    }

                }

                for (int j = 0; j < 9; j++) {

                    if (board[j][col].equals("0") && check(j, col, i) == true) {

                        g2.addEdge(i - 1, j + 9);

                    }

                }

                for (int j = rowbox1; j < maxR1; j++) {

                    for (int m = colbox1; m < maxC1; m++) {

                        if (board[j][m].equals("0") && check(j, m, i) == true) {

                            if (j - rowbox1 == 0) {

                                g3.addEdge(i - 1, (m % 3) + 9);

                            } else if (j - rowbox1 == 1) {

                                g3.addEdge(i - 1, ((m % 3) + (9 + 3)));

                            } else if (j - rowbox1 == 2) {

                                g3.addEdge(i - 1, (m % 3) + (9 + 6));

                            }
                        }

                    }

                }

                boolean v = true;
/**
 * checks if every vertex in each graph has a degree of 1
 */
                for (int u = 0; u < 9; u++) {

                    if ((degree(g1, u)) != 1) {

                        v = false;
                        break;

                    }
                    if ((degree(g2, u)) != 1) {

                        v = false;
                        break;

                    }
                    if ((degree(g3, u)) != 1) {

                        v = false;
                        break;

                    }

                }

                if (v == false) {

                    try {

                        pw = new PrintWriter(c + ".out");

                        pw.write(box + (row % 3) + (col % 3) + "-" + num);

                        pw.close();

                    } catch (FileNotFoundException ex) {

                        System.out.println("An error occured");

                    }

                } else {

                    try {

                        pw = new PrintWriter(c + ".out");

                        pw.write("");

                        pw.close();

                    } catch (FileNotFoundException ex) {

                        System.out.println("An error occured");

                    }

                }
            }

        } else {

            try {

                pw = new PrintWriter(c + ".out");

                pw.write(box + (row % 3) + (col % 3) + "-" + num);

                pw.close();

            } catch (FileNotFoundException ex) {

                System.out.println("An error occured");

            }

        }

    }
/**
 * rule 5 algorithm
 */
    public void rulefive() {

        String[] possiblevalues = new String[81];

        for (int j = 0; j < possiblevalues.length; j++) {

            possiblevalues[j] = "";

        }
/**
 * gets possible values for each empty cell in the board
 */
        int index = 0;
        int emptycells = 0 ;
        
        for (int a = 0; a < 9; a++) {

            for (int b = 0; b < 9; b++) {

                if (board[a][b].equals("0")) {
                    emptycells++;
                    
                    for (int n = 1; n <= 9; n++) {

                        if (check(a, b, n) == true) {

                            possiblevalues[index] = possiblevalues[index] + "" + n;

                        }

                    }

                }

                index++;

            }

        }
        
    EdgeWeightedGraph g = new EdgeWeightedGraph(emptycells);
    

    }
/**
 * solves the puzzling according to the rule specified in command file
 */
    public void solvepuzzle() {

        
        String[] temp2 = command.split(" ");

        if (temp2[0].equals("1a")) {
/**
 * apoplies rule 1a
 */
            ruleoneA();

        }

        if (temp2[0].equals("1b")) {
/**
 * applies rule 1b
 */
            ruleoneB();

        }

        if (temp2[0].equals("2a")) {
/**
 * applies rule 2a
 */
            ruletwoA();
        }

        if (temp2[0].equals("2b")) {
/**
 * applies rule 2b
 */
            ruletwoB();
        }

        if (temp2[0].equals("2c")) {
/**
 * applies rule 2c
 */
            ruletwoC();

        }

        if (temp2[0].equals("3")) {
/**
 * applies rule 3
 */
            rulethree();

        }

        if (temp2[0].equals("4a")) {
/**
 * applies rule 4a
 */
            rulefourA();

        }
        if (temp2[0].equals("4b")) {
/**
 * applies rule 4b
 */
            rulefourB();
        }

        if (temp2[0].equals("5")) {
/**
 * applies rule 5
 */
            rulefive();
            
        }

    }
/**
 * checks if num is valid in grid at row r and column c
 * @param r
 * @param c
 * @param num
 * @return 
 */
    public boolean check(int r, int c, int num) {

        boolean correct = true;

        for (int g = 0; g < 9; g++) {

            if ((Integer.parseInt(board[r][g]) == num)) {

                correct = false;
                break;
            }

            if (correct == true) {

                for (int b = 0; b < 9; b++) {

                    if (Integer.parseInt(board[b][c]) == num) {

                        correct = false;
                        break;
                    }

                }

            }

            if (correct == true) {

                int rowbox2 = 0;
                int colbox2 = 0;
                int maxR2 = 0;
                int maxC2 = 0;
                out:
                for (int j = 0; j <= board.length; j++) {

                    for (int k = 0; k <= board[0].length; k++) {

                        if (j % 3 == 0 && k % 3 == 0) {

                            if ((r >= j && r < j + 3) && (c >= k && c < k + 3)) {

                                rowbox2 = j;
                                colbox2 = k;
                                maxC2 = k + 3;
                                maxR2 = j + 3;
                                break out;
                            }

                        }

                    }

                }

                boxLoop:
                for (int rw = rowbox2; rw < maxR2; rw++) {

                    for (int cl = colbox2; cl < maxC2; cl++) {

                        if (Integer.parseInt(board[rw][cl]) == num) {
                            correct = false;
                            break boxLoop;

                        }

                    }

                }

            }

        }

        return correct;

    }
/**
 * checks the degree of vertex v in graph g
 * @param G
 * @param v
 * @return 
 */
    public static int degree(Graph G, int v) {

        int degree = 0;
        for (int w : G.adj(v)) {
            degree++;
        }

        return degree;
    }
/**
 * checks if cell with row r and column c only has 1 valid number
 * @param r
 * @param c
 * @return 
 */
    public int onlyplace(int r, int c) {
        int p = 0;
        for (int i = 1; i <= 9; i++) {
            if (check(r, c, i) == true) {
                p++;
            }
        }
        return p;
    }
}
