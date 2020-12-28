package acciones;

import com.opensymphony.xwork2.ActionSupport;
import com.opensymphony.xwork2.validator.annotations.RequiredStringValidator;
import java.util.Map;
import org.apache.struts2.interceptor.SessionAware;
import persistencia.PatrocinadorDAO;
import pojos.Patrocinador;

public class CrearPatrocinador extends ActionSupport implements SessionAware{
    
    private String cifPatrocinador;
    private String nombrePatrocinador;
    
    Map<String, Object> SESION;
    
    public CrearPatrocinador() {
    }

    public String getCifPatrocinador() {
        return cifPatrocinador;
    }

    @RequiredStringValidator(key = "campo.requerido")
    public void setCifPatrocinador(String cifPatrocinador) {
        this.cifPatrocinador = cifPatrocinador;
    }

    public String getNombrePatrocinador() {
        return nombrePatrocinador;
    }

    @RequiredStringValidator(key = "campo.requerido")
    public void setNombrePatrocinador(String nombrePatrocinador) {
        this.nombrePatrocinador = nombrePatrocinador;
    }
    
    
    public String execute() throws Exception {
        Patrocinador p = new PatrocinadorDAO().read(getCifPatrocinador());
       
        
        if (p != null)
        {
            p.setNombre(getNombrePatrocinador());
            new PatrocinadorDAO().update(p);
        }else{
            
            p = new Patrocinador(getCifPatrocinador(), getNombrePatrocinador());

            new PatrocinadorDAO().create(p);
        }
        
                
        getSESION().put("PATROCINADORES", new PatrocinadorDAO().list());
        
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
