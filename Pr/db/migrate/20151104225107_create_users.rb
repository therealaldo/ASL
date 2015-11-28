class CreateUsers < ActiveRecord::Migration
  def change
    create_table :users do |t|
      t.integer :soundcloud_user_id
      t.string :soundcloud_access_token

      t.timestamps null: false
    end
    add_index :users, :soundcloud_user_id
    add_index :users, :soundcloud_access_token
  end
end
