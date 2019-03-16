
import java.awt.event.ActionEvent;
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

    public sudokugui(String title) {

        super(title);

        // ---------------------------------------------------------------------swing components--------------------------------------------------------
        JPanel jPanel1 = new javax.swing.JPanel();
        JLabel lbllogo = new javax.swing.JLabel();
        JScrollPane jScrollPane1 = new javax.swing.JScrollPane();
        JTextArea txtdisplay = new javax.swing.JTextArea();
        JButton exit = new javax.swing.JButton();
        JButton btnapplyrule = new javax.swing.JButton();
        JComboBox cmbrules = new javax.swing.JComboBox();
        JLabel lblrule = new javax.swing.JLabel();

        setDefaultCloseOperation(javax.swing.WindowConstants.EXIT_ON_CLOSE);

        lbllogo.setFont(new java.awt.Font("Segoe UI", 0, 24)); // NOI18N
        lbllogo.setHorizontalAlignment(javax.swing.SwingConstants.CENTER);
        lbllogo.setText("Sudoku");

        txtdisplay.setEditable(false);
        txtdisplay.setColumns(20);
        txtdisplay.setFont(new java.awt.Font("Monospaced", 0, 14)); // NOI18N
        txtdisplay.setRows(5);
        jScrollPane1.setViewportView(txtdisplay);

        exit.setFont(new java.awt.Font("Segoe UI", 0, 14)); // NOI18N
        exit.setText("Exit");

        btnapplyrule.setFont(new java.awt.Font("Segoe UI", 0, 14)); // NOI18N
        btnapplyrule.setText("Apply Rule");

        cmbrules.setModel(new javax.swing.DefaultComboBoxModel(new String[]{"Rule 1a", "Rule 1b", "Rule 2a", "Rule 2b", "Rule 2c", "Rule 3", "Rule 4a", "Rule 4b", "Rule 5"}));

        lblrule.setFont(new java.awt.Font("Segoe UI", 0, 14)); // NOI18N
        lblrule.setText("Select Rule: ");

        javax.swing.GroupLayout jPanel1Layout = new javax.swing.GroupLayout(jPanel1);
        jPanel1.setLayout(jPanel1Layout);
        jPanel1Layout.setHorizontalGroup(
                jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                .addGroup(javax.swing.GroupLayout.Alignment.TRAILING, jPanel1Layout.createSequentialGroup()
                        .addContainerGap(javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                        .addComponent(lbllogo, javax.swing.GroupLayout.PREFERRED_SIZE, 151, javax.swing.GroupLayout.PREFERRED_SIZE)
                        .addGap(260, 260, 260))
                .addGroup(jPanel1Layout.createSequentialGroup()
                        .addContainerGap()
                        .addGroup(jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                                .addComponent(jScrollPane1)
                                .addGroup(jPanel1Layout.createSequentialGroup()
                                        .addComponent(exit, javax.swing.GroupLayout.PREFERRED_SIZE, 65, javax.swing.GroupLayout.PREFERRED_SIZE)
                                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED, 245, Short.MAX_VALUE)
                                        .addComponent(lblrule)
                                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                                        .addComponent(cmbrules, javax.swing.GroupLayout.PREFERRED_SIZE, 152, javax.swing.GroupLayout.PREFERRED_SIZE)
                                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.UNRELATED)
                                        .addComponent(btnapplyrule, javax.swing.GroupLayout.PREFERRED_SIZE, 106, javax.swing.GroupLayout.PREFERRED_SIZE)))
                        .addContainerGap())
        );
        jPanel1Layout.setVerticalGroup(
                jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                .addGroup(jPanel1Layout.createSequentialGroup()
                        .addContainerGap()
                        .addComponent(lbllogo)
                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                        .addComponent(jScrollPane1, javax.swing.GroupLayout.PREFERRED_SIZE, 389, javax.swing.GroupLayout.PREFERRED_SIZE)
                        .addGap(18, 18, 18)
                        .addGroup(jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                                .addComponent(exit)
                                .addComponent(btnapplyrule)
                                .addComponent(cmbrules, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
                                .addComponent(lblrule))
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

        cc.loadfiles();
        grid = cc.getNums();

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

        exit.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                exitActionPerformed(evt);

            }

            private void exitActionPerformed(ActionEvent evt) {

                System.exit(0);
                
            }
        });

        btnapplyrule.addActionListener(new java.awt.event.ActionListener() {

            public void actionPerformed(java.awt.event.ActionEvent evt) {
                btnapplyruleActionPerformed(evt);
            }

            private void btnapplyruleActionPerformed(ActionEvent evt) {

                if (cmbrules.getSelectedIndex() == 0) {

                    cc.ruleoneA();

                    grid = cc.getNums();

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

                    cc.ruleoneB();

                    grid = cc.getNums();

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

                    cc.ruletwoA();

                    grid = cc.getNums();

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

                }
                if (cmbrules.getSelectedIndex() == 3) {

                    cc.ruletwoB();

                    grid = cc.getNums();

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

                }
                if (cmbrules.getSelectedIndex() == 4) {

                }
                if (cmbrules.getSelectedIndex() == 5) {

                    cc.rulethree();

                    grid = cc.getNums();

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
                if (cmbrules.getSelectedIndex() == 6) {

                }
                if (cmbrules.getSelectedIndex() == 7) {

                }
                if (cmbrules.getSelectedIndex() == 8) {

                }

            }

        });

        pack();

        // ------------------------------------------event for
        // components----------------------------
        // ------------------------------------------------------------------------------------------
    }

    contents cc = new contents();
    String[][] grid;
    String command;
    Scanner sc1;
    Scanner sc2;
    int col;
    int row;

}