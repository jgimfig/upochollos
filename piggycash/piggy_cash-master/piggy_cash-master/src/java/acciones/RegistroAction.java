package acciones;

import static com.opensymphony.xwork2.Action.ERROR;
import static com.opensymphony.xwork2.Action.SUCCESS;
import com.opensymphony.xwork2.ActionSupport;
import com.opensymphony.xwork2.validator.annotations.EmailValidator;
import com.opensymphony.xwork2.validator.annotations.RequiredStringValidator;
import persistencia.UsuarioDAO;
import pojos.Usuario;


public class RegistroAction extends ActionSupport {

    private String usuario;
    private String email;
    private String contrasena;

    public RegistroAction() {
    }

    public String getUsuario() {
        return usuario;
    }

    public void setUsuario(String usuario) {
        this.usuario = usuario;
    }

    public String getEmail() {
        return email;
    }

    @EmailValidator(key = "email.error")
    @RequiredStringValidator(key = "campo.requerido")
    public void setEmail(String email) {
        this.email = email;
    }

    public String getContrasena() {
        return contrasena;
    }

    
    public void setContrasena(String contrasena) {
        this.contrasena = contrasena;
    }
    
    
    public void validate(){
        
        if ("".equals(this.getUsuario())) {
            addFieldError("usuario", getText("usuario.error"));
        }

        if ("".equals(this.getContrasena())) {
            addFieldError("contrasena", getText("contrasenia.error"));
        }
        
        if("".equals(this.getEmail())){
            addFieldError("email", getText("email.error"));
        }
        
        if (new UsuarioDAO().read(this.getUsuario()) != null){
            addFieldError("usuario", getText("usuario.existe"));
        }
    }

    public String execute() {
        try {
            Usuario u = new Usuario(getUsuario(), getEmail(), getContrasena(), "estandar");
            new UsuarioDAO().create(u);

            return SUCCESS;
        } catch (Exception ex) {
            return ERROR;
        }
    }
}
