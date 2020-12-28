package acciones;

import com.opensymphony.xwork2.ActionSupport;
import java.io.File;
import java.util.Map;
import org.apache.commons.io.FileUtils;
import org.apache.struts2.ServletActionContext;
import org.apache.struts2.interceptor.SessionAware;
import persistencia.UsuarioDAO;
import pojos.Usuario;

public class ActualizarFotoAction extends ActionSupport implements SessionAware {

    Map<String, Object> SESION;
    
    private File fotoPerfil;

    public ActualizarFotoAction() {
    }

    public File getFotoPerfil() {
        return fotoPerfil;
    }

    public void setFotoPerfil(File fotoPerfil) {
        this.fotoPerfil = fotoPerfil;
    }
    
    

    @Override
    public String execute() throws Exception {
        
        Usuario u = (Usuario) getSESION().get("USUARIO");
        String filename = u.getUsuario() + ".png";
        
        // Si el usuario tiene una sesión iniciada se actualiza su foto
        if (getFotoPerfil() != null)
        {
            String filePath = ServletActionContext.getServletContext().getRealPath("/").concat("Vistas" + File.separator + "imagenes" + File.separator + "usuarios");
            String filePathDEV = filePath.replace("build" + File.separator, "");

            File fileToCreate = new File(filePath, filename.toLowerCase());
            File fileToCreateDEV = new File(filePathDEV, filename.toLowerCase());

            FileUtils.copyFile(getFotoPerfil(), fileToCreate);
            FileUtils.copyFile(getFotoPerfil(), fileToCreateDEV);

            u.setFoto(filename);
            new UsuarioDAO().updateFoto(u.getUsuario(), filename);
            
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
