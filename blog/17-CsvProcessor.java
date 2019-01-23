

import java.io.IOException;
import java.io.InputStream;

public abstract class CsvProcessor {

	public static interface TableBuilder {
		public void addColumn(int column, String title);

		public void addCell(int row, int column, String value);

		public void build();
	}

	private enum Separator {
		COMA, NEWLINE
	}

	private class CsvItem {
		String value;
		Separator separator;
	}

	protected abstract InputStream createInputStream();

	protected abstract TableBuilder createTableBuilder();

	public void process() throws IOException {
		InputStream inputStream = createInputStream();
		try {
			TableBuilder builder = createTableBuilder();
			boolean isHeader = true;
			int row = 0;
			int column = 0;
			do {
				CsvItem item = readNextItem(inputStream);
				if (item.separator == Separator.COMA) {
					if (isHeader) {
						builder.addColumn(column, item.value);
						column++;
					} else {
						builder.addCell(row, column, item.value);
						column++;
					}
				} else if (item.separator == Separator.NEWLINE) {
					if (isHeader) {
						builder.addColumn(column, item.value);
						row = 0;
						column = 0;
						isHeader = false;
					} else {
						builder.addCell(row, column, item.value);
						row++;
						column = 0;
					}
				} else {
					throw new RuntimeException("Unmanaged separator: " + item.separator);
				}
			} while (inputStream.available() != 0);
			builder.build();
		} finally {
			inputStream.close();
		}
	}

	private CsvItem readNextItem(InputStream inputStream) throws IOException {
		CsvItem item = new CsvItem();
		item.value = "";
		while (true) {
			int read = inputStream.read();
			String character;
			if (read == -1) {
				character = "\n";
			} else {
				character = new String(new int[] { read }, 0, 1);
			}
			if (character.equals(",")) {
				item.separator = Separator.COMA;
				return item;
			} else if (character.equals("\n")) {
				item.separator = Separator.NEWLINE;
				return item;
			} else {
				item.value += character;
			}
		}
	}

}
