import static org.junit.Assert.assertEquals;
import static org.junit.Assert.assertTrue;

import org.junit.After;
import org.junit.BeforeClass;
import org.junit.Test;

public  class AppTest {

    private static jumble app;

    @BeforeClass
    public static void initApp() {
        app = new jumble();
    }

    @After
    public void afterEachTest() {
        System.out.println("Finished Test");
    }

    @Test
    public void gotSameLength() {
        assertEquals(app.jumbledString("Wow Example!", 2L).length(), 12);
    }

    @Test
    public void jumbledHello() {
        assertEquals(app.jumbledString("Wow Example!", 2L), "e WxwmEla!po");
    }

}