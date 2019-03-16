/*
------------------------------------------------------------------------------------------------------------
Mawande Nyoni
Connect four
3/02/2019
----------------------------------------------------------------------------------------------------------
*/
import java.util.Scanner;
import javax.swing.JOptionPane;
import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.util.Date;
import java.util.concurrent.TimeUnit;
import java.text.SimpleDateFormat;
import java.text.DateFormat;
import java.io.PrintWriter;

public class Connectfour {

	String board[][] = new String[7][6];
	
	public void startboard(){
		for (int k = 0; k < 7; k++) {
			for (int h = 0; h < 6; h++) {
				board[k][h] = "";
			}
		}
	}

	//player 1 plays R
	//player 2 plays Y
	String move = "";
	int playerturn = 1;

	public boolean checkwin(int row, int col) {

	int matching = 0;
	boolean match = false;

	if(playerturn == 1){

		if(match == false){

			for(int i = 0; i < 6; i++){
				for(int j = 0 ; j < 4; j++){
					if((i+3) < 6){	
						if(board[row][i+j].equals("R")){
							matching++;
						}
					}
				}
				if(matching == 4){
					match = true;
					break;
				}else{
					matching = 0;
				}
			}	
		}
	
		if(match == false){

			for(int i = 0; i < 7; i++){
				for(int j = 0 ; j < 4; j++){
					if((i+3) < 7){	
						if(board[i+j][col].equals("R")){
							matching++;
						}
					}
				}
				if(matching == 4){
					match = true;
					break;
				}else{
					matching = 0;
				}
			}	
		}

		if(match == false){
			box:
			for(int i = 0; i < 4; i++){
				for(int k = 0 ;k < 3; k++){
					if(((i+3) < 7) && ((k+3) < 6)){
						for(int z = 0; z < 4; z++){
							if(board[i+z][k+z].equals("R")){
								matching++;
							}
						}
						if(matching == 4){
							match = true;
							break box;
						}else{
							matching = 0;
						}
					}
				}
			}
		}
		if(match == false){
			box:
			for(int i = 6; i >= 3; i--){
				for(int k = 5 ;k >= 2; k--){
					if(((i-3) >= 0) && ((k-3) > 0 )){
						for(int z = 0; z < 4; z++){
							if(board[i-z][k-z].equals("R")){
								matching++;
							}
						}
						if(matching == 4){
							match = true;
							break box;
						}else{
							matching = 0;
						}
					}
				}
			}
		}

	}else{

		if(match == false){

			for(int i = 0; i < 6; i++){
				for(int j = 0 ; j < 4; j++){
					if((i+3) < 6){	
						if(board[row][i+j].equals("Y")){
							matching++;
						}
					}
				}
				if(matching == 4){
					match = true;
					break;
				}else{
					matching = 0;
				}
			}	
		}
	
		if(match == false){

			for(int i = 0; i < 7; i++){
				for(int j = 0 ; j < 4; j++){
					if((i+3) < 7){	
						if(board[i+j][col].equals("Y")){
							matching++;
						}
					}
				}
				if(matching == 4){
					match = true;
					break;
				}else{
					matching = 0;
				}
			}	
		}

		if(match == false){
			box:
			for(int i = 0; i < 4; i++){
				for(int k = 0 ;k < 3; k++){
					if(((i+3) < 7) && ((k+3) < 6)){
						for(int z = 0; z < 4; z++){
							if(board[i+z][k+z].equals("Y")){
								matching++;
							}
						}
						if(matching == 4){
							match = true;
							break box;
						}else{
							matching = 0;
						}
					}
				}
			}
		}
		if(match == false){
			box:
			for(int i = 6; i >= 3; i--){
				for(int k = 5 ;k >= 2; k--){
					if(((i-3) >= 0) && ((k-3) > 0 )){
						for(int z = 0; z < 4; z++){
							if(board[i-z][k-z].equals("Y")){
								matching++;
							}
						}
						if(matching == 4){
							match = true;
							break box;
						}else{
							matching = 0;
						}
					}
				}
			}
		}

	}
	return match;
}


	public void display() {
		
		for (int c = 6; c >= 0; c--) {
			for (int d = 0; d < 6; d++) {
				if (board[c][d].isEmpty()) {
					System.out.printf(String.format("%3s", "."));
				} else {
					System.out.printf(String.format("%3s", board[c][d]));
				}
			}
			System.out.println();
		}
		System.out.println();
	}

	public int availrow(int col) {

		int lastrow = 0;

		check:
		for (int p = 0; p < 7; p++) {
			if (board[p][col].isEmpty()) {
				lastrow = p;
				break check;
			}
		}
		return lastrow;
	}

	public void play(int row, int col) {
		if (colfull(col) == true) {
			JOptionPane.showMessageDialog(null, "Sorry, column already full!");
			System.exit(0);
		} else {
			if (playerturn == 1) {
				board[row][col] = "R";
			} else {
				board[row][col] = "Y";
			}
		}
	}

	public boolean isfull() {
		int empty = 0;
		for (int a = 0; a < 7; a++) {
			for (int b = 0; b < 6; b++) {
				if (board[a][b].isEmpty()) {
				}
				empty++;
			}
		}
		if (empty > 0) {

			return false;
		} else {
			return true;
		}
	}

	public boolean colfull(int col) {
		
		int empty = 0;

		for (int i = 0; i < 7; i++) {
			if (board[i][col].isEmpty()) {
				empty++;
			}
		}
		if (empty > 0) {
			return false;
		} else {
			return true;
		}
	}
	
	public void matchstatus(String message){
	
	try{	
		DateFormat dd = new SimpleDateFormat("yyyy/MM/dd HH:mm:ss");
		Date d1 =  new Date();
		FileWriter fw =  new FileWriter("Status.txt", true);
		PrintWriter pw = new PrintWriter(fw);
		pw.println(message+ " on "+dd.format(d1));
		pw.close();
	}catch(IOException err){
		System.out.println("Error occured");	
	}
	}
	
	public static void main(String args []) {

		try {

			int mode = Integer.parseInt(JOptionPane.showInputDialog("Enter mode number\n 1. AI\n 2. Dual"));
			if((mode != 1) && (mode != 2)){
				JOptionPane.showMessageDialog(null, "Invalid input!");
				System.exit(0);
			}
			Connectfour cf = new Connectfour();
			int row = 0;
			Scanner sc = new Scanner(System.in);
			
			System.out.println("Start");

			cf.startboard();
	
			cf.display();

			gameplay:
			while (cf.isfull() == false) {

				if (mode == 1) {    
					//-----------------------------------------------------------------------------------player----------------------------------------
					cf.playerturn = 1;

					int col = Integer.parseInt(JOptionPane.showInputDialog("Enter column number"))-1;

					if (col > 5 || col < 0) {
						String m = "Invalid input!";
						cf.matchstatus(m);
						JOptionPane.showMessageDialog(null, "Invalid input!");
						System.exit(0);
					} else {
						if (cf.isfull()) {
							String m = "Draw!!!";
							cf.matchstatus(m);
							JOptionPane.showMessageDialog(null, "Draw!!!!");
							System.exit(0);
						} else {
							row = cf.availrow(col);
							cf.play(row, col);
						}
					}
			cf.display();

			if(cf.checkwin(row, col) == true){
				if(cf.playerturn == 1){
				cf.matchstatus("You win!!!!!");
				JOptionPane.showMessageDialog(null, "You win!!!");
				System.exit(0);
			}else{
				cf.matchstatus("AI wins!!!");
				JOptionPane.showMessageDialog(null, "AI wins!!!");
				System.exit(0);
			}	
			}
					
//----------------------------------------------------------------------------------AI-------------------------------------------
					cf.playerturn = 2;

					boolean valid = false;

					while(valid == false){
						col = (int) (Math.random() * (5 - 0 + 1) + 0);
						if(cf.colfull(col) == false){
							valid = true;
						}
					}


					if (col > 5 || col < 0) {
						cf.matchstatus("Invalid input!");
						JOptionPane.showMessageDialog(null, "Invalid input!");
						System.exit(0);
					} else {
						if (cf.isfull()) {
							cf.matchstatus("Draw!!!");
							JOptionPane.showMessageDialog(null, "Draw!!!!");
						} else {
							row = cf.availrow(col);
							cf.play(row, col);
						}
					}
	
			cf.display();

			if(cf.checkwin(row, col) == true){
				if(cf.playerturn == 1){
				cf.matchstatus("You win!!!!");
				JOptionPane.showMessageDialog(null, "You win!!!");
				System.exit(0);
			}else{
				cf.matchstatus("AI wins!!!");
				JOptionPane.showMessageDialog(null, "AI wins!!!");
				System.exit(0);
			}
			}

//---------------------------------------------------------------------------------------------------------------------------------------

				} else {
					//-----------------------------------------------------------------------------------player 1----------------------------------------
					cf.playerturn = 1;

					int col = Integer.parseInt(JOptionPane.showInputDialog("Enter column number"))-1;

					if (col > 5 || col < 0) {
						cf.matchstatus("Invalid input!");
						JOptionPane.showMessageDialog(null, "Invalid input!");
						System.exit(0);
					} else {
						if (cf.isfull()) {
							cf.matchstatus("Draw!!!");
							JOptionPane.showMessageDialog(null, "Draw!!!!");
							System.exit(0);
						} else {
							row = cf.availrow(col);
							cf.play(row, col);
						}
					}

			cf.display();

			if(cf.checkwin(row, col) == true){
				if(cf.playerturn == 1){
				cf.matchstatus("Player 1 wins!!!");
				JOptionPane.showMessageDialog(null, "Player 1 wins!!!");
				System.exit(0);
			}else{
				cf.matchstatus("Player 2 wins!!!!");
				JOptionPane.showMessageDialog(null, "Player 2 wins!!!");
				System.exit(0);
			}
			}

//----------------------------------------------------------------------------------player 2-------------------------------------------
					cf.playerturn = 2;

					col = Integer.parseInt(JOptionPane.showInputDialog("Enter column number")) -1 ;

					if (col > 5 || col < 0) {
						cf.matchstatus("Invalid input!");
						JOptionPane.showInputDialog("Invalid input!");
						System.exit(0);
					} else {
						if (cf.isfull()) {
						cf.matchstatus("Draw!!!");
							JOptionPane.showMessageDialog(null, "Draw!!!!");
							System.exit(0);
						} else {
							row = cf.availrow(col);
							cf.play(row, col);
						}
					}
			cf.display();

			if(cf.checkwin(row, col) == true){
				if(cf.playerturn == 1){
				cf.matchstatus("Player 2 wins!!!!");
				JOptionPane.showMessageDialog(null, "Player 1 wins!!!");
				System.exit(0);
			
			}else{
				cf.matchstatus("Player 2 wins!!!!");	
				JOptionPane.showMessageDialog(null, "Player 2 wins!!!");
				System.exit(0);
			}
			
			}

					

//---------------------------------------------------------------------------------------------------------------------------------------
				}
			}

		} catch (Exception err) {
			
		if(err.getMessage() == null){
			
				System.out.println("An error occured");
		}else{
				System.out.println(err.getMessage());
		}

			System.exit(0);
		}
	}
}
