package acciones;

import com.opensymphony.xwork2.ActionSupport;
import java.util.HashMap;
import java.util.Map;
import org.apache.struts2.interceptor.SessionAware;
import persistencia.UsuarioDAO;
import pojos.Usuario;


public class EliminarCuentaAction extends ActionSupport implements SessionAware {
    
    Map<String, Object> SESION;
    
    public EliminarCuentaAction() {
    }
    
    @Override
    public String execute() throws Exception {
       
        Usuario u = (Usuario) getSESION().get("USUARIO");
       
        if (u != null)
        {
            new UsuarioDAO().delete(u);
            
            getSESION().clear();
            setSession(new HashMap<>());
        }
        
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
