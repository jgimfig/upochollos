package acciones;

import com.opensymphony.xwork2.ActionSupport;
import java.util.Map;
import org.apache.struts2.interceptor.SessionAware;
import persistencia.PatrocinadorDAO;

public class EliminarPatrocinador extends ActionSupport implements SessionAware{
    
    private String cifEliminarPatrocinador;
    
    Map<String, Object> SESION;
    
    public EliminarPatrocinador() {
    }

    public String getCifEliminarPatrocinador() {
        return cifEliminarPatrocinador;
    }

    public void setCifEliminarPatrocinador(String cifEliminarPatrocinador) {
        this.cifEliminarPatrocinador = cifEliminarPatrocinador;
    }
    
    
    
    public String execute() throws Exception {
        new PatrocinadorDAO().delete(getCifEliminarPatrocinador());
        
        getSESION().put("PATROCINADORES",  new PatrocinadorDAO().list());
        
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
