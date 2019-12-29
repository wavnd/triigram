
import java.io.File;
import java.io.FileNotFoundException;
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

	private String command = "";
	private String board[][] = new String[9][9];

	public contents() {

	}

	public void loadfiles() {

		try {

			sc = new Scanner(new File("board.ins"));

			while (sc.hasNextLine()) {

				line = sc.nextLine();

			}

			for (int i = 0; i < 9; i++) {

				for (int u = 0; u < 9; u++) {

					board[i][u] = line.charAt(counter1) + "";
					counter1++;

				}

			}

		} catch (FileNotFoundException e) {

			System.out.println("An error ocuured");

		}

		try {

			sc = new Scanner(new File("command.cf"));

			while (sc.hasNextLine()) {

				command = sc.nextLine();

			}

		} catch (FileNotFoundException e) {

			System.out.println("An error occured");

		}

	}

	public String[][] getNums() {

		return board;

	}

	public String getCommands() {

		return command;

	}

	public void display() {

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

		for (int i = 0; i < numbers.length; i++) {

			if (numbers[i] == false) {

				board[row][col] = (i + 1) + "";
				break;
			}

		}

		try {

			pw = new PrintWriter("c_1.out");
			pw.write(box + rOriginal + colOriginal + "+" + (board[row][col]));
			pw.close();

		} catch (FileNotFoundException ex) {

			System.out.println("An error occured");

		}

	}

	public void ruleoneB() {

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

			pw = new PrintWriter("c_1.out");
			pw.write(box + rOriginal + colOriginal + "+" + (board[row][col]));
			pw.close();

		} catch (FileNotFoundException ex) {

			System.out.println("An error occured");

		}

	}

	public void ruletwoA() {

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

		int rowcount = 0;
		int colcount = 0;
		boolean validR = true;
		boolean validC = true;

		colLoop: for (int i = colbox1; i < maxC1; i++) {

			if (i != col) {

				for (int m = 0; m < 9; m++) {

					if (Integer.parseInt(board[m][i]) == num) {

						validR = false;

					}

				}

				if (validR == true) {

					break colLoop;

				}

			}

		}
		RowLoop: for (int i = rowbox1; i < maxR1; i++) {

			if (i != row) {

				for (int m = 0; m < 9; m++) {

					if (Integer.parseInt(board[i][m]) == num) {

						validC = false;

					}

				}

				if (validC == true) {

					break RowLoop;

				}

			}

		}

		String line = "";
		String region = "";

		if (validR == true) {

			for (int a = 0; a < 9; a++) {

				if (a >= 0 && a <= 2) {

					region = "A";

				}
				if (a >= 3 && a <= 5) {

					region = "B";

				}
				if (a >= 6 && a <= 8) {

					region = "C";

				}

				if (a >= maxC1 && board[row][a].equals("0")) {

					line = line + region + (row % 3) + (a % 3) + "-" + num;

				}
			}
		}

		if (validC == true) {

			for (int a = 0; a < 9; a++) {

				if (a >= 0 && a <= 2) {

					region = "A";

				}
				if (a >= 3 && a <= 5) {

					region = "D";

				}
				if (a >= 6 && a <= 8) {

					region = "G";

				}

				if (a >= maxR1 && board[a][col].equals("0")) {

					line = line + region + (a % 3) + (col % 3) + "-" + num;

				}

			}
		}

		try {

			pw = new PrintWriter("c_1.out");
			pw.write(line);
			pw.close();

		} catch (FileNotFoundException ex) {

			System.out.println("An error occured");

		}

	}

	public void ruletwoB() {

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
		out: for (int j = 0; j <= board.length; j++) {

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

		int rowcheck = 0;
		int colcheck = 0;

		if (box.equals("B")) {

			colcheck = col + 3;

		}
		if (box.equals("C")) {

			colcheck = col + 6;

		}

		if (box.equals("D")) {

			rowcheck = row + 3;

		}
		if (box.equals("E")) {

			colcheck = col + 3;
			rowcheck = row + 6;

		}
		if (box.equals("F")) {

			colcheck = col + 6;
			rowcheck = row + 3;

		}

		if (box.equals("G")) {

			rowcheck = row + 6;

		}
		if (box.equals("H")) {

			rowcheck = row + 6;
			colcheck = col + 3;

		}
		if (box.equals("I")) {

			rowcheck = row + 6;
			colcheck = col + 6;
		}

		int counterR = 0;
		int counterC = 0;
		boolean valid = true;

		for (int i = colbox1; i < maxC1; i++) {

			valid = true;

			for (int c = 0; c < 9; c++) {

				if (board[c][i].equals(num)) {

					valid = false;
					break;

				}

			}

			if (valid == true) {

				counterR++;

			}

		}

		for (int i = rowbox1; i < maxR1; i++) {

			valid = true;

			for (int c = 0; c < 9; c++) {

				if (board[i][c].equals(num)) {

					valid = false;
					break;

				}

			}

			if (valid == true) {

				counterC++;

			}

		}

		String output = "";
		boolean valid2 = true;

		if (counterR >= 2) {

			for (int k = rowbox1; k < maxR1; k++) {

				if (k != row) {

					for (int p = colbox1; p < maxC1; p++) {

						valid2 = true;

						for (int a = 0; a < 9; a++) {

							if (board[k][a].equals(num + "")) {

								valid2 = false;
								break;

							}

						}

						for (int u = 0; u < 9; u++) {

							if (board[u][p].equals(num + "")) {

								valid2 = false;
								break;
							}

						}

						if (valid2 == true) {

							output = output + box + (k % 3) + "" + (p % 3) + "-" + num;

						}
					}

				}

			}

		} else if (counterC >= 2) {

			for (int k = rowbox1; k < maxR1; k++) {

				for (int p = colbox1; p < maxC1; p++) {

					if (p != col) {

						valid2 = true;

						for (int a = 0; a < 9; a++) {

							if (board[k][a].equals(num + "")) {

								valid2 = false;
								break;

							}

						}

						for (int u = 0; u < 9; u++) {

							if (board[u][p].equals(num + "")) {

								valid2 = false;
								break;
							}

						}

						if (valid2 == true) {

							output = output + box + (k % 3) + "" + (p % 3) + "-" + num;

						}
					}

				}

			}

		}

		try {

			pw = new PrintWriter("c_1.out");

			pw.write(output);

			pw.close();

		} catch (FileNotFoundException ex) {

			System.out.println("An error occured");

		}

	}

	public void rulethree() {

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
		out: for (int j = 0; j <= board.length; j++) {

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
		outerLoop: for (int i = 1; i <= 9; i++) {

			if (countnums < 2) {

				boolean found = false;

				boxLoop: for (int rw = rowbox1; rw < maxR1; rw++) {

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
		System.out.println(nums);

		String[] s = nums.split("");
		int num1 = Integer.parseInt(s[0]);
		int num2 = Integer.parseInt(s[1]);
		String rPos = "";
		String cPos = "";
		String rPos2 = "";
		String cPos2 = "";
		boolean valid = true;

		Checkcells: for (int rwC = rowbox1; rwC < maxR1; rwC++) {

			for (int clC = colbox1; clC < maxC1; clC++) {

				valid = true;

				if (rwC != row || clC != col) {

					boxLoop: for (int rw = rowbox1; rw < maxR1; rw++) {

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

			loop: for (int a = 0; a < 9; a++) {

				for (int g = 0; g < 9; g++) {

					if (g != col
							&& (Integer.parseInt(board[row][g]) == num1 || Integer.parseInt(board[row][g]) == num2)) {

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
					out: for (int j = 0; j <= board.length; j++) {

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

					boxLoop: for (int rw = rowbox1; rw < maxR1; rw++) {

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

			loop2: for (int a = 0; a < 9; a++) {

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
						out: for (int j = 0; j <= board.length; j++) {

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

						boxLoop: for (int rw = rowbox1; rw < maxR1; rw++) {

							for (int cl = colbox1; cl < maxC1; cl++) {

								if (Integer.parseInt(board[rw][cl]) == num1
										|| Integer.parseInt(board[rw][cl]) == num2) {
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
		out: for (int j = 0; j <= board.length; j++) {

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
		System.out.println(rPos + " " + cPos);

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
		out: for (int j = 0; j <= board.length; j++) {

			for (int k = 0; k <= board[0].length; k++) {

				if (j % 3 == 0 && k % 3 == 0) {

					if ((Integer.parseInt(rPos) >= j && Integer.parseInt(rPos) < j + 3)
							&& (Integer.parseInt(cPos) >= k && Integer.parseInt(cPos) < k + 3)) {

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

			if (presentnums2[i] == false) {

				printme = printme + box + "" + (row % 3) + "" + (col % 3) + "-" + (i + 1);

			}
		}
		for (int i = 0; i < presentnums.length; i++) {

			if (presentnums[i] == false) {

				printme = printme + region + "" + (Integer.parseInt(rPos) % 3) + "" + (Integer.parseInt(cPos) % 3) + "-"
						+ (i + 1);

			}
		}

		if (printme.length() > 3) {

			try {

				pw = new PrintWriter("c_1.out");

				pw.write(printme);

				pw.close();

			} catch (FileNotFoundException ex) {

				System.out.println("An error occured");

			}

		} else {

			System.out.println("Cannot be solved!");

		}

	}

	public void solvepuzzle() {

		String[] temp2 = command.split(" ");

		if (temp2[0].equals("1a")) {

			ruleoneA();

		}

		if (temp2[0].equals("1b")) {

			ruleoneB();

		}

		if (temp2[0].equals("2a")) {

			ruletwoA();
		}

		if (temp2[0].equals("2b")) {

			ruletwoB();
		}

		if (temp2[0].equals("2c")) {

		}

		if (temp2[0].equals("3")) {

			rulethree();

		}

	}

}