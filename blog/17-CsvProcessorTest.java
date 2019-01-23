

import java.io.IOException;
import java.io.InputStream;
import java.io.StringBufferInputStream;
import java.util.Arrays;
import java.util.LinkedList;
import java.util.List;

import org.junit.Test;
import static org.junit.Assert.*;


@SuppressWarnings("deprecation")
public class CsvProcessorTest {

	@Test
	public void test() throws IOException {
		List<String> headers = new LinkedList<>();
		List<List<String>> tableContent = new LinkedList<>();
		boolean[] built = {false};
		CsvProcessor.TableBuilder tableBuilder = new CsvProcessor.TableBuilder() {
			
			@Override
			public void addColumn(int column, String title) {
				headers.add(column, title);
				tableContent.add(column, new LinkedList<>());
			}

			@Override
			public void addCell(int row, int column, String value) {
				tableContent.get(column).add(row, value);
			}

			@Override
			public void build() {
				built[0] = true;
			}
		};
		CsvProcessor processor = new CsvProcessor() {

			@Override
			protected TableBuilder createTableBuilder() {
				return tableBuilder;
			}

			@Override
			protected InputStream createInputStream() {
				return new StringBufferInputStream("H1,H2,H3\nV11,V12,V13\nV21,V22,V23");
			}
		};
		processor.process();
		
		assertEquals(Arrays.asList("H1", "H2", "H3"), headers);
		
		assertEquals(3, tableContent.size());
		assertEquals(Arrays.asList("V11", "V21"), tableContent.get(0));
		assertEquals(Arrays.asList("V12", "V22"), tableContent.get(1));
		assertEquals(Arrays.asList("V13", "V23"), tableContent.get(2));
		
		assertTrue(built[0]);
	}

}
