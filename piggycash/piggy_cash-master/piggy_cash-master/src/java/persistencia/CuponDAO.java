package persistencia;

import java.util.ArrayList;
import java.util.List;
import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;
import pojos.Cupon;

public class CuponDAO implements DAO<Cupon, Integer>{
    private Session sesion = null;

    @Override
    public void create(Cupon elemento) {
        try{
            sesion = HibernateUtil.getSessionFactory().openSession();
        }catch(HibernateException e){
            sesion = HibernateUtil.getSessionFactory().getCurrentSession();
        }
        Transaction tx = null;
        try {
            tx = sesion.beginTransaction();
            sesion.save(elemento);
            tx.commit();
        } catch (HibernateException e) {
            if (tx != null) {
                tx.rollback();
            }
            e.printStackTrace();
        }
    }

    @Override
    public void update(Cupon elemento) {
        try{
            sesion = HibernateUtil.getSessionFactory().openSession();
        }catch(HibernateException e){
            sesion = HibernateUtil.getSessionFactory().getCurrentSession();
        }
        Transaction tx = null;
        try {
            tx = sesion.beginTransaction();
            sesion.update(elemento);
            tx.commit();
        } catch (HibernateException e) {
            if (tx != null) {
                tx.rollback();
            }
            e.printStackTrace();
        }
    }

    @Override
    public void delete(Cupon elemento) {
        try{
            sesion = HibernateUtil.getSessionFactory().openSession();
        }catch(HibernateException e){
            sesion = HibernateUtil.getSessionFactory().getCurrentSession();
        }
        Transaction tx = null;
        try {
            tx = sesion.beginTransaction();
            sesion.delete(elemento);
            tx.commit();
        } catch (HibernateException e) {
            if (tx != null) {
                tx.rollback();
            }
            e.printStackTrace();
        }
    }
    
    /* DADO UN PK, BORRA LA INSTANCIA DE UN CUPÓN */
    public void delete(String pk) {
        try{
            sesion = HibernateUtil.getSessionFactory().openSession();
        }catch(HibernateException e){
            sesion = HibernateUtil.getSessionFactory().getCurrentSession();
        }
        Transaction tx = null;
        try {
            tx = sesion.beginTransaction();
            
            Query q = sesion.createQuery("delete from Cupon where id='"+pk+"'");
            
            q.executeUpdate();
            tx.commit();
            
        } catch (HibernateException e) {
            if (tx != null) {
                tx.rollback();
            }
            e.printStackTrace();
        }
    }

    @Override
    public Cupon read(Integer primaryKey) {
        try{
            sesion = HibernateUtil.getSessionFactory().openSession();
        }catch(HibernateException e){
            sesion = HibernateUtil.getSessionFactory().getCurrentSession();
        }
        Transaction tx = null;
        try {
            tx = sesion.beginTransaction();
            Query query = sesion.createQuery("from Cupon where id='"+primaryKey+"'");
            tx.commit();
            return (Cupon) query.uniqueResult();
        } catch (HibernateException e) {
            if (tx != null) {
                tx.rollback();
            }
            e.printStackTrace();
        }
        return null;
    }

    @Override
    public List<Cupon> list() {
        try{
            sesion = HibernateUtil.getSessionFactory().openSession();
        }catch(HibernateException e){
            sesion = HibernateUtil.getSessionFactory().getCurrentSession();
        }
        Transaction tx = null;
        try {
            tx = sesion.beginTransaction();
            Query query = sesion.createQuery("from Cupon");
            tx.commit();
            return query.list();
        } catch (HibernateException e) {
            if (tx != null) {
                tx.rollback();
            }
            e.printStackTrace();
        }
        return null;
    }

    @Override
    public List<Integer> listPK() {
        try{
            sesion = HibernateUtil.getSessionFactory().openSession();
        }catch(HibernateException e){
            sesion = HibernateUtil.getSessionFactory().getCurrentSession();
        }
        Transaction tx = null;
        List<Integer> listaNombres = new ArrayList<>();
        List<Cupon> listaCupones;
        try {
            tx = sesion.beginTransaction();
            listaCupones = list();
            for(int i = 0; i < listaCupones.size(); i++){
                listaNombres.add(listaCupones.get(i).getId());
            }
            tx.commit();
            return listaNombres;
        } catch (HibernateException e) {
            if (tx != null) {
                tx.rollback();
            }
            e.printStackTrace();
        }
        return null;
    }
}
