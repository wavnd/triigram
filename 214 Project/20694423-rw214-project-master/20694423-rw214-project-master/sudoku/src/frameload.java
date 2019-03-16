
import java.util.Scanner;

import javax.swing.JFrame;
import javax.swing.JOptionPane;
import javax.swing.SwingUtilities;

public class frameload {

    public static void main(String[] args) {

        Scanner sc = new Scanner(System.in);

		// run the game based on the user's choice of running with a GUI or
        // command line
        String choice = JOptionPane
                .showInputDialog("Do you want to run from the user interface?" + "\n\n" + "1. Yes" + "\n" + "2. No");

        if (choice == null) {

            System.exit(0);

        }

        if (choice.equalsIgnoreCase("Yes") || choice.equals("1")) {

            // executes the runnable on the AWT thread
            SwingUtilities.invokeLater(new Runnable() {

                public void run() {

                    JFrame frame = new sudokugui("Sudoku");
                    frame.setSize(738, 614);
                    frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
                    frame.setVisible(true);

                }
            });

        } else if (choice.equalsIgnoreCase("No") || choice.equals("2")) {

            sudoku objs = new sudoku();
            objs.solve();   

        }

    }

}