
package acciones;

import com.opensymphony.xwork2.ActionSupport;
import java.util.Map;
import org.apache.struts2.interceptor.SessionAware;
import persistencia.CuponDAO;


public class EliminarCupon extends ActionSupport implements SessionAware {

    Map<String, Object> SESION;
    
    private String idEliminarCupon;

    public EliminarCupon() {
    }

    public String getIdEliminarCupon() {
        return idEliminarCupon;
    }

    public void setIdEliminarCupon(String idEliminarCupon) {
        this.idEliminarCupon = idEliminarCupon;
    }
    
    

    public String execute() throws Exception {
        
        new CuponDAO().delete(getIdEliminarCupon());
        
         getSESION().put("CUPONES", new CuponDAO().list());
        
        return SUCCESS;
    }

    public Map<String, Object> getSESION() {
        return SESION;
    }

    @Override
    public void setSession(Map<String, Object> map) {
        this.SESION = map;
    }

}
