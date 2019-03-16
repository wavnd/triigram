
/**
 * This class loads all the swing components making it possible to run the program using a GUI.
 * The program can thereafter be ran soley using the GUI, the outputs will also be displayed on the GUI.
 */
import java.awt.event.ActionEvent;
import java.io.File;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.Scanner;

import javax.swing.JButton;
import javax.swing.JComboBox;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JScrollPane;
import javax.swing.JTextArea;

public class sudokugui extends JFrame {

    public sudokugui(String title, String f) {

        super(title);

/**
* Differnt swing components are loaded
*/
        JPanel jPanel1 = new javax.swing.JPanel();
        JLabel lbllogo = new javax.swing.JLabel();
        JScrollPane jScrollPane1 = new javax.swing.JScrollPane();
        JScrollPane jScrollPane2 = new javax.swing.JScrollPane();
        JTextArea txtdisplay = new javax.swing.JTextArea();
        JButton pval = new javax.swing.JButton();
        JButton btnapplyrule = new javax.swing.JButton();
        JComboBox cmbrules = new javax.swing.JComboBox();
        JLabel lblrule = new javax.swing.JLabel();
        JTextArea txout = new javax.swing.JTextArea();
        JLabel lblN = new javax.swing.JLabel();
        JLabel jl1 = new javax.swing.JLabel();
        JComboBox cmb1 = new javax.swing.JComboBox();
        JLabel jl2 = new javax.swing.JLabel();
        JComboBox cmb2 = new javax.swing.JComboBox();
        JLabel jl3 = new javax.swing.JLabel();
        JComboBox cmb3 = new javax.swing.JComboBox();

        setDefaultCloseOperation(javax.swing.WindowConstants.EXIT_ON_CLOSE);

        lbllogo.setFont(new java.awt.Font("Segoe UI", 0, 24)); // NOI18N
        lbllogo.setHorizontalAlignment(javax.swing.SwingConstants.CENTER);
        lbllogo.setText("Sudoku");

        txtdisplay.setEditable(false);
        txtdisplay.setColumns(20);
        txtdisplay.setFont(new java.awt.Font("Monospaced", 0, 14)); // NOI18N
        txtdisplay.setRows(5);
        jScrollPane1.setViewportView(txtdisplay);

        pval.setFont(new java.awt.Font("Segoe UI", 0, 14)); // NOI18N
        pval.setText("Values");

        btnapplyrule.setFont(new java.awt.Font("Segoe UI", 0, 14)); // NOI18N

        btnapplyrule.setText("Apply Rule");

        cmbrules.setModel(new javax.swing.DefaultComboBoxModel(new String[]{"Rule 1a", "Rule 1b", "Rule 2a", "Rule 2b", "Rule 2c", "Rule 3", "Rule 4a", "Rule 4b", "Rule 5"}));

        lblrule.setFont(new java.awt.Font("Segoe UI", 0, 14)); // NOI18N
        lblrule.setText("Select Rule: ");

        txout.setColumns(20);
        txout.setRows(5);
        jScrollPane2.setViewportView(txout);

        lblN.setText("Rule effect:");

        jl1.setFont(new java.awt.Font("Tahoma", 0, 12)); // NOI18N
        jl1.setText("Box:");

        cmb1.setModel(new javax.swing.DefaultComboBoxModel(new String[]{"A", "B", "C", "D", "E", "F", "G", "H", "I"}));

        jl2.setFont(new java.awt.Font("Tahoma", 0, 12)); // NOI18N
        jl2.setText("Row:");

        cmb2.setModel(new javax.swing.DefaultComboBoxModel(new String[]{"0", "1", "2"}));

        jl3.setFont(new java.awt.Font("Tahoma", 0, 12)); // NOI18N
        jl3.setText("Coloumn:");

        cmb3.setModel(new javax.swing.DefaultComboBoxModel(new String[]{"0", "1", "2"}));

        javax.swing.GroupLayout jPanel1Layout = new javax.swing.GroupLayout(jPanel1);
        jPanel1.setLayout(jPanel1Layout);
        jPanel1Layout.setHorizontalGroup(
                jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                .addGroup(jPanel1Layout.createSequentialGroup()
                        .addContainerGap()
                        .addGroup(jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                                .addGroup(jPanel1Layout.createSequentialGroup()
                                        .addComponent(pval, javax.swing.GroupLayout.PREFERRED_SIZE, 128, javax.swing.GroupLayout.PREFERRED_SIZE)
                                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED, 361, Short.MAX_VALUE)
                                        .addComponent(lblrule)
                                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                                        .addComponent(cmbrules, javax.swing.GroupLayout.PREFERRED_SIZE, 152, javax.swing.GroupLayout.PREFERRED_SIZE)
                                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.UNRELATED)
                                        .addComponent(btnapplyrule, javax.swing.GroupLayout.PREFERRED_SIZE, 106, javax.swing.GroupLayout.PREFERRED_SIZE))
                                .addGroup(javax.swing.GroupLayout.Alignment.TRAILING, jPanel1Layout.createSequentialGroup()
                                        .addGroup(jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.TRAILING)
                                                .addGroup(jPanel1Layout.createSequentialGroup()
                                                        .addComponent(lblN)
                                                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                                                        .addComponent(jScrollPane2))
                                                .addComponent(jScrollPane1))
                                        .addGap(18, 18, 18)
                                        .addGroup(jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                                                .addGroup(jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING, false)
                                                        .addComponent(jl1)
                                                        .addComponent(cmb1, 0, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                                                        .addComponent(jl2)
                                                        .addComponent(cmb2, javax.swing.GroupLayout.PREFERRED_SIZE, 33, javax.swing.GroupLayout.PREFERRED_SIZE))
                                                .addComponent(jl3)
                                                .addComponent(cmb3, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE))))
                        .addContainerGap())
                .addGroup(javax.swing.GroupLayout.Alignment.TRAILING, jPanel1Layout.createSequentialGroup()
                        .addContainerGap(javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                        .addComponent(lbllogo, javax.swing.GroupLayout.PREFERRED_SIZE, 151, javax.swing.GroupLayout.PREFERRED_SIZE)
                        .addGap(269, 269, 269))
        );

        jPanel1Layout.setVerticalGroup(
                jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                .addGroup(jPanel1Layout.createSequentialGroup()
                        .addContainerGap()
                        .addComponent(lbllogo)
                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                        .addGroup(jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                                .addGroup(jPanel1Layout.createSequentialGroup()
                                        .addComponent(jScrollPane1, javax.swing.GroupLayout.PREFERRED_SIZE, 304, javax.swing.GroupLayout.PREFERRED_SIZE)
                                        .addGap(13, 13, 13)
                                        .addGroup(jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                                                .addGroup(jPanel1Layout.createSequentialGroup()
                                                        .addComponent(jScrollPane2, javax.swing.GroupLayout.PREFERRED_SIZE, 84, javax.swing.GroupLayout.PREFERRED_SIZE)
                                                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                                                        .addGroup(jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                                                                .addComponent(pval)
                                                                .addComponent(btnapplyrule)
                                                                .addComponent(cmbrules, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
                                                                .addComponent(lblrule)))
                                                .addComponent(lblN)))
                                .addGroup(jPanel1Layout.createSequentialGroup()
                                        .addComponent(jl1)
                                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                                        .addComponent(cmb1, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
                                        .addGap(44, 44, 44)
                                        .addComponent(jl2)
                                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                                        .addComponent(cmb2, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
                                        .addGap(43, 43, 43)
                                        .addComponent(jl3)
                                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.UNRELATED)
                                        .addComponent(cmb3, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)))
                        .addContainerGap(javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE))
        );

        javax.swing.GroupLayout layout = new javax.swing.GroupLayout(getContentPane());
        getContentPane().setLayout(layout);
        layout.setHorizontalGroup(
                layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                .addComponent(jPanel1, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
        );
        layout.setVerticalGroup(
                layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                .addComponent(jPanel1, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
        );

/**
* Loads the board file and creates the the board Dipalys the initial
* board
*/
        try {

            String line = "";
            int counter = 0;

            Scanner sc = new Scanner(new File(f + ".ins"));

            while (sc.hasNextLine()) {

                line = sc.nextLine();

            }

            for (int i = 0; i < 9; i++) {

                for (int u = 0; u < 9; u++) {

                    grid[i][u] = line.charAt(counter) + "";
                    counter++;

                }

            }

        } catch (Exception e) {

            System.out.println("An error ocuured");

        }

        for (int i = 0; i < 9; i++) {

            if (i % 3 == 0 && i != 0) {

                txtdisplay.append("\n");

            }

            for (int j = 0; j < 9; j++) {

                if (j % 3 == 0 && j != 0) {

                    txtdisplay.append(String.format("%7s", " "));
                }

                if (Integer.parseInt(grid[i][j]) == 0) {

                    txtdisplay.append(String.format("%7s", "."));

                } else {

                    txtdisplay.append(String.format("%7s", grid[i][j]));

                }

            }

            txtdisplay.append("\n");

        }

        pval.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                pvalActionPerformed(evt);

            }

            private void pvalActionPerformed(ActionEvent evt) {
/**
* uses the selected cell to display the possible values that
* can be insterted into the cell, NOTE: this only works for
* empty cells Some cells may not have possible values, in this
* case an appropriate message will be displayed
*/
                String box = cmb1.getSelectedItem().toString();
                row = Integer.parseInt(cmb2.getSelectedItem().toString());
                col = Integer.parseInt(cmb3.getSelectedItem().toString());
/**
* Converts the selected row and column to numbers which
* correspond to the rest of the board according to the selected
* subgrid rows are from 0-8 columns from 0-8
*/
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

                String[] possiblevalues = new String[81];

                for (int j = 0; j < possiblevalues.length; j++) {

                    possiblevalues[j] = "";

                }
/**
* gets the possible values for each empty cell in the board
*/
                int index = 0;

                for (int a = 0; a < 9; a++) {

                    for (int b = 0; b < 9; b++) {

                        if (grid[a][b].equals("0")) {

                            for (int n = 1; n <= 9; n++) {

                                if (check(a, b, n) == true) {

                                    possiblevalues[index] = possiblevalues[index] + "" + n;

                                }

                            }

                        }

                        index++;

                    }

                }

                if (row == 0) {

                    if (possiblevalues[col + 9].equals("")) {

                        JOptionPane.showMessageDialog(null, "No possible values");

                    } else {

                        JOptionPane.showMessageDialog(null, "Possible values are " + possiblevalues[col]);

                    }

                }
/**
* when the button is clicked the possible values are displayed
* on a pop-up, if there's no possible value, and appropriate
* message is displayed Only empty cells can be selected
*/
                if (row == 1) {

                    if (possiblevalues[col + 9].equals("")) {

                        JOptionPane.showMessageDialog(null, "No possible values");

                    } else {

                        JOptionPane.showMessageDialog(null, "Possible values are " + possiblevalues[col + 9]);

                    }

                }
                if (row == 2) {

                    if (possiblevalues[col + 9].equals("")) {

                        JOptionPane.showMessageDialog(null, "No possible values");

                    } else {

                        JOptionPane.showMessageDialog(null, "Possible values are " + possiblevalues[col + 18]);

                    }
                }
                if (row == 3) {

                    if (possiblevalues[col + 9].equals("")) {

                        JOptionPane.showMessageDialog(null, "No possible values");

                    } else {

                        JOptionPane.showMessageDialog(null, "Possible values are " + possiblevalues[col + 27]);

                    }
                }
                if (row == 4) {

                    if (possiblevalues[col + 9].equals("")) {

                        JOptionPane.showMessageDialog(null, "No possible values");

                    } else {

                        JOptionPane.showMessageDialog(null, "Possible values are " + possiblevalues[col + 36]);

                    }
                }
                if (row == 5) {

                    if (possiblevalues[col + 9].equals("")) {

                        JOptionPane.showMessageDialog(null, "No possible values");

                    } else {

                        JOptionPane.showMessageDialog(null, "Possible values are " + possiblevalues[col + 45]);

                    }
                }
                if (row == 6) {

                    if (possiblevalues[col + 9].equals("")) {

                        JOptionPane.showMessageDialog(null, "No possible values");

                    } else {

                        JOptionPane.showMessageDialog(null, "Possible values are " + possiblevalues[col + 54]);

                    }
                }
                if (row == 7) {

                    if (possiblevalues[col + 9].equals("")) {

                        JOptionPane.showMessageDialog(null, "No possible values");

                    } else {

                        JOptionPane.showMessageDialog(null, "Possible values are " + possiblevalues[col + 63]);

                    }
                }
                if (row == 8) {

                    if (possiblevalues[col + 9].equals("")) {

                        JOptionPane.showMessageDialog(null, "No possible values");

                    } else {

                        JOptionPane.showMessageDialog(null, "Possible values are " + possiblevalues[col + 72]);

                    }
                }

            }
        });
        String box = cmb1.getSelectedItem().toString();
        btnapplyrule.addActionListener(new java.awt.event.ActionListener() {

            public void actionPerformed(java.awt.event.ActionEvent evt) {
                btnapplyruleActionPerformed(evt);
            }

            private void btnapplyruleActionPerformed(ActionEvent evt) {
/**
* applies the desired rule to the specified rule List of rules
* can be found under the Rules combo box Stores the row,
* coloumn and subgrid letter.
*/
                if (cmbrules.getSelectedIndex() == 0) {

                    String box = cmb1.getSelectedItem().toString();
                    row = Integer.parseInt(cmb2.getSelectedItem().toString());
                    col = Integer.parseInt(cmb3.getSelectedItem().toString());
                    int rOriginal = row;
                    int colOriginal = col;
/**
* Converts the selected row and column to numbers which
* correspond to the rest of the board according to the
* selected subgrid rows are from 0-8 columns from 0-8
*/
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

                    boolean[] numbers = new boolean[9];

                    for (int i = 0; i < 9; i++) {

                        if (!grid[row][i].equals("0")) {

                            numbers[Integer.parseInt(grid[row][i]) - 1] = true;

                        }

                    }

                    int rowbox1 = 0;
                    int colbox1 = 0;
                    int maxR1 = 0;
                    int maxC1 = 0;

/**
* gets the subgrid boundaries for the selected cell
*/
                    for (int j = 0; j <= grid.length; j++) {

                        for (int k = 0; k <= grid[0].length; k++) {

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

                    int r1 = 0;
                    int c1 = 0;

                    for (int p = rowbox1; p < maxR1; p++) {

                        for (int o = colbox1; o < maxC1; o++) {

                            if (!grid[p][o].equals("0")) {

                                numbers[Integer.parseInt(grid[p][o]) - 1] = true;

                            }

                        }

                    }
                    for (int i = 0; i < 9; i++) {

                        if (!grid[i][col].equals("0")) {

                            numbers[Integer.parseInt(grid[i][col]) - 1] = true;

                        }

                    }

                    int howmany = 0;
                    int ii = 0;

                    for (int i = 0; i < numbers.length; i++) {

                        if (numbers[i] == false) {

                            ii = i;
                            howmany++;

                        }

                    }

                    if (howmany == 1) {

                        grid[row][col] = (ii + 1) + "";

                    }

                    try {

                        PrintWriter pw = new PrintWriter(f + ".out");

                        if (!(grid[row][col].equals("0"))) {

                            txout.setText(box + rOriginal + colOriginal + "+" + (grid[row][col]));
                            pw.write(box + rOriginal + colOriginal + "+" + (grid[row][col]));

                        } else {

                            txout.setText("");
                            pw.write("");

                        }

                        pw.close();

                    } catch (FileNotFoundException ex) {

                        System.out.println("An error occured");

                    }

                    txtdisplay.setText("");

                    for (int i = 0; i < 9; i++) {

                        if (i % 3 == 0 && i != 0) {

                            txtdisplay.append("\n");

                        }

                        for (int j = 0; j < 9; j++) {

                            if (j % 3 == 0 && j != 0) {

                                txtdisplay.append(String.format("%7s", " "));
                            }

                            if (Integer.parseInt(grid[i][j]) == 0) {

                                txtdisplay.append(String.format("%7s", "."));

                            } else {

                                txtdisplay.append(String.format("%7s", grid[i][j]));

                            }

                        }

                        txtdisplay.append("\n");

                    }

                    JOptionPane.showMessageDialog(null, "Rule 1a has been applied");

                }
                if (cmbrules.getSelectedIndex() == 1) {
/**
* applies Rules 1b
*/
                    String box = cmb1.getSelectedItem().toString();
                    row = Integer.parseInt(cmb2.getSelectedItem().toString());
                    col = Integer.parseInt(cmb3.getSelectedItem().toString());
                    int rOriginal = row;
                    int colOriginal = col;
                    int empty = 0;
                    int sum = 0;
                    int nums = 0;
/**
* Converts the selected row and column to numbers which
* correspond to the rest of the board according to the
* selected subgrid rows are from 0-8 columns from 0-8
*/
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
                    sum = 0;
                    nums = 0;

                    boolean found = false;

                    nums = 0;
                    sum = 0;

                    for (int i = 0; i < 9; i++) {

                        sum += Integer.parseInt(grid[row][i]);

                        if (grid[row][i].equals("0")) {

                            empty = i;

                        } else {

                            nums++;

                        }

                    }

                    if (nums == 8) {

                        grid[row][empty] = (45 - sum) + "";
                        found = true;

                    }

                    if (found == false) {

                        int rowbox1 = 0;
                        int colbox1 = 0;
                        int maxR1 = 0;
                        int maxC1 = 0;
/**
* gets subgrid boundries for the selected cell
*/
                        for (int j = 0; j <= grid.length; j++) {

                            for (int k = 0; k <= grid[0].length; k++) {

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

                        int r1 = 0;
                        int c1 = 0;
                        nums = 0;
                        sum = 0;

                        for (int p = rowbox1; p < maxR1; p++) {

                            for (int o = colbox1; o < maxC1; o++) {

                                sum += Integer.parseInt(grid[p][o]);

                                if (grid[p][o].equals("0")) {

                                    r1 = p;
                                    c1 = o;

                                } else {

                                    nums++;

                                }

                            }

                        }
                        if (nums == 8) {

                            grid[r1][c1] = (45 - sum) + "";
                            found = true;

                        }

                    }

                    if (found == false) {

                        sum = 0;
                        empty = 0;
                        nums = 0;

                        for (int i = 0; i < 9; i++) {

                            sum += Integer.parseInt(grid[i][col]);

                            if (grid[i][col].equals("0")) {

                                empty = i;

                            } else {

                                nums++;

                            }

                        }

                        if (nums == 8) {

                            grid[empty][col] = (45 - sum) + "";

                        }

                    }
/**
* prints the rule effect and displays the updated board
*/
                    try {

                        PrintWriter pw = new PrintWriter(f + ".out");

                        if (!(grid[row][col].equals("0"))) {
                            txout.setText(box + rOriginal + colOriginal + "+" + (grid[row][col]));
                            pw.write(box + rOriginal + colOriginal + "+" + (grid[row][col]));

                        } else {

                            txout.setText("");
                            pw.write("");

                        }
                        pw.close();

                    } catch (FileNotFoundException ex) {

                        System.out.println("An error occured");

                    }

                    txtdisplay.setText("");

                    for (int i = 0; i < 9; i++) {

                        if (i % 3 == 0 && i != 0) {

                            txtdisplay.append("\n");

                        }

                        for (int j = 0; j < 9; j++) {

                            if (j % 3 == 0 && j != 0) {

                                txtdisplay.append(String.format("%7s", " "));
                            }

                            if (Integer.parseInt(grid[i][j]) == 0) {

                                txtdisplay.append(String.format("%7s", "."));

                            } else {

                                txtdisplay.append(String.format("%7s", grid[i][j]));

                            }

                        }

                        txtdisplay.append("\n");

                    }

                    JOptionPane.showMessageDialog(null, "Rule 1b has been applied applied");

                }
                if (cmbrules.getSelectedIndex() == 2) {
/**
* applies Rule 2a
*/
                    try {
/**
* gets the row, column and subgrid letter from the
* combo boxes
*/
                        String box = cmb1.getSelectedItem().toString();
                        row = Integer.parseInt(cmb2.getSelectedItem().toString());
                        col = Integer.parseInt(cmb3.getSelectedItem().toString());
                        int num = Integer.parseInt(JOptionPane.showInputDialog("Input number:"));

/**
* Converts the selected row and column to numbers which
* correspond to the rest of the board according to the
* selected subgrid rows are from 0-8 columns from 0-8
*/
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

                        int rowbox1 = 0;
                        int colbox1 = 0;
                        int maxR1 = 0;
                        int maxC1 = 0;
/**
* gets the subgrid boundaries for selected grid
*/
                        for (int j = 0; j <= grid.length; j++) {

                            for (int k = 0; k <= grid[0].length; k++) {

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

                        for (int i = colbox1; i < maxC1; i++) {

                            if (grid[row][i].equals("0")) {

                                colcount++;

                            }

                        }

                        if (colcount == 3) {

                            validR = true;

                        }

                        if (validR == false) {

                            for (int i = rowbox1; i < maxR1; i++) {

                                if (grid[i][col].equals("0")) {

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

                                    if (grid[row][y].equals("0") && check(row, y, num) == true) {
/**
* calculates the subgrid letter using
* the row and column values
*/
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
/**
* calculates the subgrid letter using the
* row and column values
*/
                                    if (grid[y][col].equals("0") && (check(y, col, num) == true)) {

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
/**
* prints the output of the rule intp the Rule
* effect text area, also into the output text file
*/
                            txout.setText(o);
                            PrintWriter pw = new PrintWriter(f + ".out");
                            pw.printf(o);
                            pw.close();

                        } catch (FileNotFoundException ex) {

                            System.out.println("An error occured");

                        }

                        txtdisplay.setText("");

                        for (int i = 0; i < 9; i++) {

                            if (i % 3 == 0 && i != 0) {

                                txtdisplay.append("\n");

                            }

                            for (int j = 0; j < 9; j++) {

                                if (j % 3 == 0 && j != 0) {

                                    txtdisplay.append(String.format("%7s", " "));
                                }

                                if (Integer.parseInt(grid[i][j]) == 0) {

                                    txtdisplay.append(String.format("%7s", "."));

                                } else {

                                    txtdisplay.append(String.format("%7s", grid[i][j]));

                                }

                            }

                            txtdisplay.append("\n");

                        }

                        JOptionPane.showMessageDialog(null, "Rule 2a has been applied");

                    } catch (Exception er) {

                        JOptionPane.showMessageDialog(null, "Error occured");

                    }

                }
                if (cmbrules.getSelectedIndex() == 3) {
/**
* applies rule 2b
*/
                    try {

                        String box = cmb1.getSelectedItem().toString();
                        row = Integer.parseInt(cmb2.getSelectedItem().toString());
                        col = Integer.parseInt(cmb3.getSelectedItem().toString());
                        int num = Integer.parseInt(JOptionPane.showInputDialog("Input number:"));
/**
* Converts the selected row and column to numbers which
* correspond to the rest of the board according to the
* selected subgrid rows are from 0-8 columns from 0-8
*/
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

                        int rowbox1 = 0;
                        int colbox1 = 0;
                        int maxR1 = 0;
                        int maxC1 = 0;

                        out:
                        for (int j = 0; j <= grid.length; j++) {

                            for (int k = 0; k <= grid[0].length; k++) {

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

                            if (grid[row][i].equals("0") && check(row, i, num) == true) {

                                colcount++;

                            }

                        }

                        if (colcount > 1) {

                            validR = true;

                        }

                        for (int i = rowbox1; i < maxR1; i++) {

                            if (grid[i][col].equals("0") && check(i, col, num)) {

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

                                    if (i != row && grid[i][j].equals("0") && check(i, j, num) == true) {

                                        o = o + box + (i % 3) + (j % 3) + "-" + num + "\n";

                                    }

                                }

                            }

                        } else if (validC == true && validR == false) {

                            for (int i = rowbox1; i < maxR1; i++) {

                                for (int j = colbox1; j < maxC1; j++) {

                                    if (j != col && grid[i][j].equals("0") && check(i, j, num) == true) {

                                        o = o + box + (i % 3) + (j % 3) + "-" + num + "\n";

                                    }

                                }

                            }

                        } else if (validR == true && validC == true) {

                            if (colcount > rowcount) {

                                for (int i = rowbox1; i < maxR1; i++) {

                                    for (int j = colbox1; j < maxC1; j++) {

                                        if (i != row && grid[i][j].equals("0") && check(i, j, num) == true) {

                                            o = o + box + (i % 3) + (j % 3) + "-" + num + "\n";

                                        }

                                    }

                                }

                            } else if (row > colcount) {

                                for (int i = rowbox1; i < maxR1; i++) {

                                    for (int j = colbox1; j < maxC1; j++) {

                                        if (j != col && grid[i][j].equals("0") && check(i, j, num) == true) {

                                            o = o + box + (i % 3) + (j % 3) + "-" + num + "\n";

                                        }

                                    }

                                }

                            } else if (rowcount == colcount) {

                                for (int i = rowbox1; i < maxR1; i++) {

                                    for (int j = colbox1; j < maxC1; j++) {

                                        if (i != row && grid[i][j].equals("0") && check(i, j, num) == true) {

                                            o = o + box + (i % 3) + (j % 3) + "-" + num + "\n";

                                        }

                                    }

                                }

                            }

                        }

                        try {

                            PrintWriter pw = new PrintWriter(f + ".out");
                            txout.setText(o);
                            pw.printf(o);

                            pw.close();

                        } catch (IOException ex) {

                            System.out.println("An error occured");

                        }
                        txtdisplay.setText("");

                        for (int i = 0; i < 9; i++) {

                            if (i % 3 == 0 && i != 0) {

                                txtdisplay.append("\n");

                            }

                            for (int j = 0; j < 9; j++) {

                                if (j % 3 == 0 && j != 0) {

                                    txtdisplay.append(String.format("%7s", " "));
                                }

                                if (Integer.parseInt(grid[i][j]) == 0) {

                                    txtdisplay.append(String.format("%7s", "."));

                                } else {

                                    txtdisplay.append(String.format("%7s", grid[i][j]));

                                }

                            }

                            txtdisplay.append("\n");

                        }

                        JOptionPane.showMessageDialog(null, "Rule 2b has been applied");

                    } catch (Exception er) {

                        JOptionPane.showMessageDialog(null, "Error occured");

                    }

                }

                if (cmbrules.getSelectedIndex() == 4) {
/**
* applies Rule 2c
*/
                    String box = cmb1.getSelectedItem().toString();
                    row = Integer.parseInt(cmb2.getSelectedItem().toString());
                    col = Integer.parseInt(cmb3.getSelectedItem().toString());
                    String o = "";

                    try {
/**
* correspond to the rest of the board according to the
* selected subgrid rows are from 0-8 columns from 0-8
*/
                        PrintWriter pw = new PrintWriter(f + ".out");

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

                        int rowbox1 = 0;
                        int colbox1 = 0;
                        int maxR1 = 0;
                        int maxC1 = 0;
                        out:
                        for (int j = 0; j <= grid.length; j++) {

                            for (int k = 0; k <= grid[0].length; k++) {

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

                            if (grid[row][i].equals("0")) {

                                colcount++;

                            }

                        }

                        if (colcount == 3) {

                            validR = true;

                        }

                        if (validR == false) {

                            for (int i = rowbox1; i < maxR1; i++) {

                                if (grid[i][col].equals("0")) {

                                    rowcount++;

                                }

                            }

                            if (rowcount == 3) {

                                validC = true;

                            }

                        }

                        if (validR == true && validC == false) {

                            int cc = 0;

                            for (int i = colbox1; i < maxC1; i++) {

                                for (int j = 0; j < 9; j++) {

                                    if (!(grid[j][i].equals("0")) && i != col) {

                                        cc++;

                                    }

                                }

                            }
                            for (int i = rowbox1; i < maxR1; i++) {

                                for (int j = 0; j < 9; j++) {

                                    if (!(grid[i][j].equals("0")) && i != row) {

                                        cc++;

                                    }

                                }

                            }

                            int numslist[] = new int[cc];
                            int counter = 0;

                            for (int i = colbox1; i < maxC1; i++) {

                                for (int j = 0; j < 9; j++) {

                                    if (!(grid[j][i].equals("0")) && i != col) {

                                        numslist[counter] = Integer.parseInt(grid[j][i]);
                                        counter++;

                                    }

                                }

                            }

                            for (int i = rowbox1; i < maxR1; i++) {

                                for (int j = 0; j < 9; j++) {

                                    if (!(grid[i][j].equals("0")) && i != row) {

                                        numslist[counter] = Integer.parseInt(grid[i][j]);
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

                                    if (!(grid[i][j].equals("0")) && i != row) {

                                        cc++;

                                    }

                                }

                            }
                            for (int i = colbox1; i < maxC1; i++) {

                                for (int j = 0; j < 9; j++) {

                                    if (!(grid[j][i].equals("0")) && i != col) {

                                        cc++;

                                    }

                                }

                            }

                            int numslist[] = new int[cc];
                            int counter = 0;

                            for (int i = rowbox1; i < maxR1; i++) {

                                for (int j = 0; j < 9; j++) {

                                    if (!(grid[i][j].equals("0")) && i != row) {

                                        numslist[counter] = Integer.parseInt(grid[i][j]);
                                        counter++;

                                    }

                                }
                            }
                            for (int i = colbox1; i < maxC1; i++) {

                                for (int j = 0; j < 9; j++) {

                                    if (!(grid[j][i].equals("0")) && i != col) {

                                        numslist[counter] = Integer.parseInt(grid[j][i]);
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

                                    if (!(grid[j][i].equals("0")) && i != col) {

                                        cc++;

                                    }

                                }

                            }
                            for (int i = rowbox1; i < maxR1; i++) {

                                for (int j = 0; j < 9; j++) {

                                    if (!(grid[i][j].equals("0")) && i != row) {

                                        cc++;

                                    }

                                }

                            }

                            int numslist[] = new int[cc];
                            int counter = 0;

                            for (int i = colbox1; i < maxC1; i++) {

                                for (int j = 0; j < 9; j++) {

                                    if (!(grid[j][i].equals("0")) && i != col) {

                                        numslist[counter] = Integer.parseInt(grid[j][i]);
                                        counter++;

                                    }

                                }

                            }

                            for (int i = rowbox1; i < maxR1; i++) {

                                for (int j = 0; j < 9; j++) {

                                    if (!(grid[i][j].equals("0")) && i != row) {

                                        numslist[counter] = Integer.parseInt(grid[i][j]);
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
                        txout.setText(o);

                        pw.printf(o);

                        pw.close();

                    } catch (IOException ex) {

                        System.out.println("An error occured");

                    }

                    try {

                        txout.setText(o);
                        PrintWriter pw = new PrintWriter(f + ".out");

                        pw.write(o);

                        pw.close();

                    } catch (FileNotFoundException ex) {

                        txout.setText("An error occured");

                    }

                    txtdisplay.setText("");

                    for (int i = 0; i < 9; i++) {

                        if (i % 3 == 0 && i != 0) {

                            txtdisplay.append("\n");

                        }

                        for (int j = 0; j < 9; j++) {

                            if (j % 3 == 0 && j != 0) {

                                txtdisplay.append(String.format("%7s", " "));
                            }

                            if (Integer.parseInt(grid[i][j]) == 0) {

                                txtdisplay.append(String.format("%7s", "."));

                            } else {

                                txtdisplay.append(String.format("%7s", grid[i][j]));

                            }

                        }

                        txtdisplay.append("\n");

                    }

                    JOptionPane.showMessageDialog(null, "Rule 2c has been applied");

                }

                if (cmbrules.getSelectedIndex() == 5) {
/** 
 * applies Rule 3
 */
                    try {

                        String nums = "";
                        int countnums = 0;
                        String box = cmb1.getSelectedItem().toString();
                        row = Integer.parseInt(cmb2.getSelectedItem().toString());
                        col = Integer.parseInt(cmb3.getSelectedItem().toString());
                        int rOriginal = row;
                        int colOriginal = col;
                        int rowbox1 = 0;
                        int colbox1 = 0;
                        int maxR1 = 0;
                        int maxC1 = 0;

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
                        out:
                        for (int j = 0; j <= grid.length; j++) {

                            for (int k = 0; k <= grid[0].length; k++) {

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

                                        if (Integer.parseInt(grid[rw][cl]) == i) {

                                            found = true;
                                            break boxLoop;

                                        }

                                    }

                                }

                                if (found == false) {

                                    for (int y = 0; y < 9; y++) {

                                        if (Integer.parseInt(grid[row][y]) == i) {

                                            found = true;

                                            break;

                                        }

                                    }
                                }

                                if (found == false) {

                                    for (int z = 0; z < 9; z++) {

                                        if (Integer.parseInt(grid[z][col]) == i) {

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

                            PrintWriter pw = new PrintWriter(f + ".out");

                            Checkcells:
                            for (int rwC = rowbox1; rwC < maxR1; rwC++) {

                                for (int clC = colbox1; clC < maxC1; clC++) {

                                    valid = true;

                                    if (rwC != row || clC != col) {

                                        boxLoop:
                                        for (int rw = rowbox1; rw < maxR1; rw++) {

                                            for (int cl = colbox1; cl < maxC1; cl++) {

                                                if ((Integer.parseInt(grid[rw][cl]) == num1 || Integer.parseInt(grid[rw][cl]) == num2)) {

                                                    valid = false;
                                                    break boxLoop;
                                                }

                                            }

                                        }

                                        if (valid == true) {

                                            for (int y = 0; y < 9; y++) {

                                                if ((Integer.parseInt(grid[rwC][y]) == num1 || Integer.parseInt(grid[rwC][y]) == num2)) {

                                                    valid = false;

                                                    break;

                                                }

                                            }

                                        }

                                        if (valid == true) {

                                            for (int x = 0; x < 9; x++) {

                                                if ((Integer.parseInt(grid[x][clC]) == num1 || Integer.parseInt(grid[x][clC]) == num2)) {

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

                                        if (g != col && (Integer.parseInt(grid[row][g]) == num1 || Integer.parseInt(grid[row][g]) == num2)) {

                                            valid = false;

                                        }

                                    }

                                    if (valid == true) {

                                        for (int b = 0; b < 9; b++) {

                                            if (b != row) {

                                                if (Integer.parseInt(grid[b][a]) == num1 || Integer.parseInt(grid[b][a]) == num2) {

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
                                        for (int j = 0; j <= grid.length; j++) {

                                            for (int k = 0; k <= grid[0].length; k++) {

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

                                                if (Integer.parseInt(grid[rw][cl]) == num1 || Integer.parseInt(grid[rw][cl]) == num2) {
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

                                            if ((Integer.parseInt(grid[g][col]) == num1 || Integer.parseInt(grid[g][col]) == num2)) {

                                                valid = false;

                                            }

                                        }

                                        if (valid == true) {

                                            for (int b = 0; b < 9; b++) {

                                                if (b != col) {

                                                    if (Integer.parseInt(grid[a][b]) == num1 || Integer.parseInt(grid[a][b]) == num2) {

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
                                            for (int j = 0; j <= grid.length; j++) {

                                                for (int k = 0; k <= grid[0].length; k++) {

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

                                                    if (Integer.parseInt(grid[rw][cl]) == num1 || Integer.parseInt(grid[rw][cl]) == num2) {
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
                            for (int j = 0; j <= grid.length; j++) {

                                for (int k = 0; k <= grid[0].length; k++) {

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

                                    if (!grid[rw][cl].equals("0")) {

                                        presentnums[Integer.parseInt(grid[rw][cl]) - 1] = true;

                                    }

                                }

                            }

                            for (int i = 0; i < 9; i++) {

                                if (!grid[row][i].equals("0")) {

                                    presentnums[Integer.parseInt(grid[row][i]) - 1] = true;

                                }

                            }
                            for (int i = 0; i < 9; i++) {

                                if (!grid[i][col].equals("0")) {

                                    presentnums[Integer.parseInt(grid[i][col]) - 1] = true;

                                }

                            }

                            boolean presentnums2[] = new boolean[9];

                            rowbox1 = 0;
                            colbox1 = 0;
                            maxR1 = 0;
                            maxC1 = 0;
                            out:
                            for (int j = 0; j <= grid.length; j++) {

                                for (int k = 0; k <= grid[0].length; k++) {

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

                                    if (!grid[rw][cl].equals("0")) {

                                        presentnums2[Integer.parseInt(grid[rw][cl]) - 1] = true;

                                    }

                                }

                            }

                            for (int i = 0; i < 9; i++) {

                                if (!grid[Integer.parseInt(rPos)][i].equals("0")) {

                                    presentnums2[Integer.parseInt(grid[Integer.parseInt(rPos)][i]) - 1] = true;

                                }

                            }
                            for (int i = 0; i < 9; i++) {

                                if (!grid[i][Integer.parseInt(cPos)].equals("0")) {

                                    presentnums2[Integer.parseInt(grid[i][Integer.parseInt(cPos)]) - 1] = true;
                                }

                            }
/**
 * calculates the subgrid letter usig the values of the column and row
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

                                txout.setText(printme);
                                pw.printf(printme);

                            } else {

                                System.out.println("Cannot be solved!");

                            }

                            pw.close();

                        } catch (IOException ex) {

                            txout.setText("An error occured");

                        }

                        txtdisplay.setText("");

                        for (int i = 0; i < 9; i++) {

                            if (i % 3 == 0 && i != 0) {

                                txtdisplay.append("\n");

                            }

                            for (int j = 0; j < 9; j++) {

                                if (j % 3 == 0 && j != 0) {

                                    txtdisplay.append(String.format("%7s", " "));
                                }

                                if (Integer.parseInt(grid[i][j]) == 0) {

                                    txtdisplay.append(String.format("%7s", "."));

                                } else {

                                    txtdisplay.append(String.format("%7s", grid[i][j]));

                                }

                            }

                            txtdisplay.append("\n");

                        }

                        JOptionPane.showMessageDialog(null, "Rule 3 has been applied");

                    } catch (Exception er) {

                        JOptionPane.showMessageDialog(null, "Error occured");
                    }

                }

                if (cmbrules.getSelectedIndex() == 6) {

/**
* applies Rule 4a
*/
                    try {

                        String box = cmb1.getSelectedItem().toString();
                        row = Integer.parseInt(cmb2.getSelectedItem().toString());
                        col = Integer.parseInt(cmb3.getSelectedItem().toString());
                        int num = Integer.parseInt(JOptionPane.showInputDialog("Enter number: "));

/**
* Converts the selected row and column to numbers which
* correspond to the rest of the board according to the
* selected subgrid rows are from 0-8 columns from 0-8
*/
                        try {

                            PrintWriter pw = new PrintWriter(f + ".out");

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
* checks if the number is initially valid in the
* selected cell
*/
                            boolean checkme = true;

                            for (int e = 0; e < 9; e++) {

                                if (grid[e][col].equals(num + "")) {

                                    checkme = false;
                                    break;
                                }

                            }

                            if (checkme == true) {

                                for (int y = 0; y < 9; y++) {

                                    if (grid[row][y].equals(num + "")) {

                                        checkme = false;
                                        break;
                                    }

                                }

                            }

                            if (checkme == true) {
/**
* creates the Graph of size 18 rows from 0 - 8
* and columns from 0 - 17
*/

                                Graph g = new Graph(18);

                                for (int i = 0; i < 9; i++) {

                                    for (int j = 0; j < 9; j++) {

                                        if (grid[i][j].equals("0")) {
/**
* adds an edge from the row to the
* column if the number in that cell
* is valid
*/
                                            if (check(i, j, num) == true) {

                                                g.addEdge(i, j + 9);
                                            }
                                        }

                                    }

                                }

                                boolean fits = true;
                                /**
* checks if the degree of each vertex (0 to
* V-1) is
*/
                                for (int u = 0; u < 9; u++) {

                                    if (degree(g, u) != 1) {

                                        fits = false;
                                        break;

                                    }

                                }

                                if (fits == false) {

                                    try {

                                        txout.setText(box + (row % 3) + (col % 3) + "-" + num);
                                        pw.write(box + (row % 3) + (col % 3) + "-" + num);

                                        pw.close();

                                    } catch (Exception ex) {

                                        System.out.println("An error occured");

                                    }

                                } else {

                                    try {
                                        txout.setText("");
                                        pw.write("");

                                        pw.close();

                                    } catch (Exception ex) {

                                        System.out.println("An error occured");

                                    }

                                }

                            } else {

                                txout.setText("");
                                pw.write("");

                                pw.close();

                            }

                        } catch (IOException ex) {

                            txout.setText("An error occured");

                        }

                        txtdisplay.setText("");

                        for (int i = 0; i < 9; i++) {

                            if (i % 3 == 0 && i != 0) {

                                txtdisplay.append("\n");

                            }

                            for (int j = 0; j < 9; j++) {

                                if (j % 3 == 0 && j != 0) {

                                    txtdisplay.append(String.format("%7s", " "));
                                }

                                if (Integer.parseInt(grid[i][j]) == 0) {

                                    txtdisplay.append(String.format("%7s", "."));

                                } else {

                                    txtdisplay.append(String.format("%7s", grid[i][j]));

                                }

                            }

                            txtdisplay.append("\n");

                        }

                        JOptionPane.showMessageDialog(null, "Rule 4a has been applied");

                    } catch (Exception er) {

                        System.out.println("Error occured");

                    }

                }

                if (cmbrules.getSelectedIndex() == 7) {

/**
* applies Rule 4b
*/
                    String box = cmb1.getSelectedItem().toString();
                    row = Integer.parseInt(cmb2.getSelectedItem().toString());
                    col = Integer.parseInt(cmb3.getSelectedItem().toString());
                    int num = Integer.parseInt(JOptionPane.showInputDialog("Enter number: "));;

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

                    int rowbox1 = 0;
                    int colbox1 = 0;
                    int maxR1 = 0;
                    int maxC1 = 0;

                    out:
                    for (int j = 0; j <= grid.length; j++) {

                        for (int k = 0; k <= grid[0].length; k++) {

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
/**
 * creates 3 graphs 
 * g1 for digits and row
 * g2 for digits column
 * g3 for digits and subgrid
 */
                        Graph g1 = new Graph(18);
                        Graph g2 = new Graph(18);
                        Graph g3 = new Graph(18);

                        //row
                        for (int i = 1; i <= 9; i++) {

                            for (int j = 0; j < 9; j++) {

                                if (grid[row][j].equals("0") && check(row, j, i) == true) {

                                    g1.addEdge(i - 1, j + 9);

                                }

                            }

                            for (int j = 0; j < 9; j++) {

                                if (grid[j][col].equals("0") && check(j, col, i) == true) {

                                    g2.addEdge(i - 1, j + 9);

                                }

                            }

                            for (int j = rowbox1; j < maxR1; j++) {

                                for (int m = colbox1; m < maxC1; m++) {

                                    if (grid[j][m].equals("0") && check(j, m, i) == true) {

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
/**
 * checks if the degree for each vertex in each graph is 1 
 */
                            boolean v = true;

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

                                    PrintWriter pw = new PrintWriter(f + ".out");
                                    txout.setText(box + (row % 3) + (col % 3) + "-" + num);
                                    pw.write(box + (row % 3) + (col % 3) + "-" + num);

                                    pw.close();

                                } catch (FileNotFoundException ex) {

                                    System.out.println("An error occured");

                                }

                            } else {

                                try {

                                    PrintWriter pw = new PrintWriter(f + ".out");
                                    txout.setText("");
                                    pw.write("");

                                    pw.close();

                                } catch (FileNotFoundException ex) {

                                    System.out.println("An error occured");

                                }

                            }
                        }

                    } else {

                        try {

                            PrintWriter pw = new PrintWriter(f + ".out");
                            txout.setText(box + (row % 3) + (col % 3) + "-" + num);
                            pw.write(box + (row % 3) + (col % 3) + "-" + num);

                            pw.close();

                        } catch (FileNotFoundException ex) {

                            System.out.println("An error occured");

                        }

                    }

                    txtdisplay.setText("");

                    for (int i = 0; i < 9; i++) {

                        if (i % 3 == 0 && i != 0) {

                            txtdisplay.append("\n");

                        }

                        for (int j = 0; j < 9; j++) {

                            if (j % 3 == 0 && j != 0) {

                                txtdisplay.append(String.format("%7s", " "));
                            }

                            if (Integer.parseInt(grid[i][j]) == 0) {

                                txtdisplay.append(String.format("%7s", "."));

                            } else {

                                txtdisplay.append(String.format("%7s", grid[i][j]));

                            }

                        }

                        txtdisplay.append("\n");

                    }

                    JOptionPane.showMessageDialog(null, "Rule 4b has been applied");

                }

                if (cmbrules.getSelectedIndex() == 8) {

                }

            }

        }
        );

        pack();

    }
/**
 * checks if num is a valid number number in row r, column c of grid
 * @param r
 * @param c
 * @param num
 * @return 
 */
  
    public boolean check(int r, int c, int num) {

        boolean correct = true;

        for (int g = 0; g < 9; g++) {

            if ((Integer.parseInt(grid[r][g]) == num)) {

                correct = false;
                break;
            }

            if (correct == true) {

                for (int b = 0; b < 9; b++) {

                    if (Integer.parseInt(grid[b][c]) == num) {

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
                for (int j = 0; j <= grid.length; j++) {

                    for (int k = 0; k <= grid[0].length; k++) {

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

                        if (Integer.parseInt(grid[rw][cl]) == num) {
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
 * calculates the degree of vertex v in graph g
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

    String[][] grid = new String[9][9];
    String command;
    Scanner sc1;
    Scanner sc2;
    int col;
    int row;
    String file;

}
